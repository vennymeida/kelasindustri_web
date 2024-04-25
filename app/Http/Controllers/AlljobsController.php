<?php

namespace App\Http\Controllers;


use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Models\RekomendasiLoker;
use App\Models\RekomendasiLowongan;
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\StopWordRemover\StopWordRemoverFactory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AlljobsController extends Controller
{

    protected $stemmer;
    protected $stopWordRemover;

    public function __construct()
    {

        // Membuat stemmer dan stop word remover untuk bahasa Indonesia
        $stemmerFactory = new StemmerFactory();
        $this->stemmer = $stemmerFactory->createStemmer();

        $stopWordRemoverFactory = new StopWordRemoverFactory();
        $this->stopWordRemover = $stopWordRemoverFactory->createStopWordRemover();
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $perusahaan = Perusahaan::all();
            $stopwords = DB::table('stop_word')->pluck('text')->toArray();

            // dd($stopwords);

            $lulusanData = DB::table('lulusans')
                ->select('id', 'ringkasan')
                ->where('user_id', $user->id)
                ->get();
            $lokerData = DB::table('lokers')
                ->select('id', 'persyaratan', 'deskripsi', 'keahlian')
                ->where('status', 'dibuka')
                ->get();

            // Fungsi untuk memproses teks dan menghitung TF untuk setiap dokumen
            $processTextAndCalculateTF = function ($text) use ($stopwords) {
                // Mengonversi teks ke huruf kecil untuk menghilangkan case sensitivity
                $textLower = strtolower($text);

                // Tokenisasi: Memecah teks menjadi kata-kata dengan menghilangkan tanda baca
                $textWithoutPunctuation = preg_replace('/[^\w\s]/', '', $textLower);

                // Menghilangkan stopwords
                $wordsArray = explode(' ', $textWithoutPunctuation);
                $filteredWords = array_filter($wordsArray, function ($word) use ($stopwords) {
                    return !in_array($word, $stopwords) && !empty($word);
                });

                $stemmedWords = array_map(function ($word) {
                    // Melakukan stemming pada setiap kata
                    return $this->stemmer->stem($word);
                }, $filteredWords);

                // Filter out any empty elements
                $stemmedWords = array_filter($stemmedWords, function ($word) {
                    return !empty($word);
                });

                return $this->calculateTF($stemmedWords);
            };

            // Mengolah data lulusan dan loker, dan menghitung TF untuk setiap dokumen
            foreach ($lulusanData as $lulusan) {
                $lulusan->tf = $processTextAndCalculateTF($lulusan->ringkasan);
            }

            foreach ($lokerData as $loker) {
                $loker->tf = $processTextAndCalculateTF($loker->persyaratan . ' ' . $loker->deskripsi . ' ' . $loker->keahlian);
            }


            // Mengumpulkan semua dokumen untuk menghitung IDF
            $allDocuments = $lulusanData->merge($lokerData);
            $idf = $this->calculateIDF($allDocuments->pluck('tf')->toArray());

            // Menghitung TF-IDF
            foreach ($lulusanData as $lulusan) {
                $lulusan->tfidf = $this->calculateTFIDF($lulusan->tf, $idf);
                // dump($lulusan);
            }
            foreach ($lokerData as $loker) {
                $loker->tfidf = $this->calculateTFIDF($loker->tf, $idf);
                // dump($loker);
            }
            // die();

            // Menghitung cosine similarity
            $rekomendasi = [];
            foreach ($lulusanData as $lulusan) {
                foreach ($lokerData as $loker) {
                    $similarity = $this->calculateCosineSimilarity($lulusan->tfidf, $loker->tfidf);
                    $rekomendasi[] = [
                        'lulusan_id' => $lulusan->id,
                        'loker_id' => $loker->id,
                        'score_similarity' => $similarity,
                    ];
                }
            }

            // dd($lulusan);
            // dd($loker);
            // dd($lokerData);
            // dd($similarity);
            // dd($lulusan->tfidf = $this->calculateTFIDF($lulusan->tf, $idf));
            // dd($loker->tfidf = $this->calculateTFIDF($loker->tf, $idf));
            foreach ($lulusanData as $lulusan) {
                foreach ($lulusan->tf as $word => $tfValue) {
                    $existingRecord = DB::table('rekomendasis_lulusan')->where([
                        'document_id' => $lulusan->id,
                        'word' => $word,
                        'document_type' => 'lulusan'
                    ])->first();

                    if ($existingRecord) {
                        DB::table('rekomendasis_lulusan')->where('id', $existingRecord->id)->update([
                            'tf_value' => $tfValue,
                            'tfidf_value' => $lulusan->tfidf[$word] ?? 0
                        ]);
                    } else {
                        DB::table('rekomendasis_lulusan')->insert([
                            'document_id' => $lulusan->id,
                            'word' => $word,
                            'document_type' => 'lulusan',
                            'tf_value' => $tfValue,
                            'tfidf_value' => $lulusan->tfidf[$word] ?? 0
                        ]);
                    }
                }
            }


            foreach ($lokerData as $loker) {
                foreach ($loker->tf as $word => $tfValue) {
                    $existingRecord = DB::table('rekomendasis_loker')->where([
                        'document_id' => $loker->id,
                        'word' => $word,
                        'document_type' => 'loker'
                    ])->first();

                    if ($existingRecord) {
                        DB::table('rekomendasis_loker')->where('id', $existingRecord->id)->update([
                            'tf_value' => $tfValue,
                            'tfidf_value' => $loker->tfidf[$word] ?? 0
                        ]);
                    } else {
                        DB::table('rekomendasis_loker')->insert([
                            'document_id' => $loker->id,
                            'word' => $word,
                            'document_type' => 'loker',
                            'tf_value' => $tfValue,
                            'tfidf_value' => $loker->tfidf[$word] ?? 0
                        ]);
                    }
                }
            }


            foreach ($rekomendasi as $item) {
                $exists = DB::table('rekomendasilowongans')
                    ->where('lulusan_id', $item['lulusan_id'])
                    ->where('loker_id', $item['loker_id'])
                    ->first();

                if ($exists) {
                    DB::table('rekomendasilowongans')
                        ->where('lulusan_id', $item['lulusan_id'])
                        ->where('loker_id', $item['loker_id'])
                        ->update([
                            'score_similarity' => $item['score_similarity'],
                            'updated_at' => now()
                        ]);
                } else {
                    // Jika record tidak ditemukan, lakukan insert
                    DB::table('rekomendasilowongans')->insert([
                        'lulusan_id' => $item['lulusan_id'],
                        'loker_id' => $item['loker_id'],
                        'score_similarity' => $item['score_similarity'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
            $userId = Auth::id();
            $allResults = DB::table('rekomendasilowongans as rks')
                ->leftJoin('lulusans as ls', 'rks.lulusan_id', '=', 'ls.id')
                ->leftJoin('lokers as lk', 'rks.loker_id', '=', 'lk.id')
                ->leftJoin('users as u', 'ls.user_id', '=', 'u.id')
                ->leftJoin('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
                ->select(
                    'lk.id',
                    'lk.nama_loker',
                    'lk.persyaratan',
                    'lk.deskripsi',
                    'lk.gaji_atas',
                    'lk.gaji_bawah',
                    'lk.tipe_pekerjaan',
                    'lk.tgl_tutup',
                    'lk.kuota',
                    'lk.status',
                    'ls.ringkasan',
                    'ls.user_id',
                    'u.email',
                    'u.name',
                    'ps.nama_pemilik',
                    'ps.nama_perusahaan',
                    'ps.logo_perusahaan',
                    'ps.email_perusahaan',
                    'ps.alamat_perusahaan',
                    'ps.deskripsi',
                    'rks.score_similarity',
                    DB::raw('rks.score_similarity * 100 as score_similarity_persen')
                )
                ->where('lk.status', 'dibuka')
                ->where('rks.score_similarity', '>', 0)
                ->where('ls.user_id', $userId)
                ->get();

            $tableloker = DB::table('lokers as lk')
                ->join('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
                ->select(
                    'lk.id',
                    'lk.nama_loker',
                    'lk.persyaratan',
                    'lk.deskripsi',
                    'lk.gaji_atas',
                    'lk.gaji_bawah',
                    'lk.keahlian',
                    'lk.tipe_pekerjaan',
                    'lk.tgl_tutup',
                    'lk.lokasi',
                    'lk.status',
                    'ps.nama_pemilik',
                    'ps.nama_perusahaan',
                    'ps.logo_perusahaan',
                    'ps.email_perusahaan',
                    'ps.alamat_perusahaan',
                    'ps.deskripsi',
                )->when($request->input('nama_loker'), function ($query, $nama_loker) {
                    return $query->where('lk.nama_loker', 'like', '%' . $nama_loker . '%');
                })
                ->when($request->input('persyaratan'), function ($query, $name) {
                    return $query->where('lk.persyaratan', 'like', '%' . $name . '%');
                })
                ->where('lk.status', 'dibuka')
                ->paginate(10);

            return view('all-jobs', ['perusahaan' => $perusahaan, 'allResults' => $allResults, 'lokers' => $lokerData, 'lulusan' => $lulusanData, 'tableloker' => $tableloker]);
        } else {
            // Jika pengguna belum login, tampilkan semua data loker
            $tableloker = LowonganPekerjaan::paginate(10);
            return view('all-jobs', ['tableloker' => $tableloker]);
        }
    }

    // rumus
    protected function calculateTF($words)
    {
        $tf = [];
        $countWords = array_count_values($words);
        $maxCount = max($countWords);
        foreach ($countWords as $word => $count) {
            $tf[$word] = $count / $maxCount;
        }
        return $tf;
    }
    // rumus
    protected function calculateIDF($documents)
    {
        $idf = [];
        $allWords = [];

        foreach ($documents as $document) {
            $allWords = array_merge($allWords, array_keys($document));
        }

        $allWords = array_unique($allWords);

        $totalDocuments = count($documents);
        foreach ($allWords as $word) {
            $wordDocumentCounts = 0;
            foreach ($documents as $document) {
                if (array_key_exists($word, $document)) {
                    $wordDocumentCounts += 1;
                }
            }

            if ($wordDocumentCounts > 0) {
                $idf[$word] = log($totalDocuments / $wordDocumentCounts);
            } else {
                $idf[$word] = 0;
            }
        }

        return $idf;
    }

    // rumus
    protected function calculateTFIDF($tf, $idf)
    {
        $tfidf = [];
        foreach ($tf as $word => $tfScore) {
            $tfidf[$word] = $tfScore * (isset($idf[$word]) ? $idf[$word] : 0);
        }
        return $tfidf;
    }

    // rumus
    protected function calculateCosineSimilarity($vec1, $vec2)
    {
        $intersect = array_intersect_key($vec1, $vec2);
        $dotProduct = 0;
        foreach ($intersect as $key => $value) {
            $dotProduct += $value * $vec2[$key];
        }
        $magnitude1 = sqrt(array_sum(array_map(function ($val) {
            return $val * $val;
        }, $vec1)));
        $magnitude2 = sqrt(array_sum(array_map(function ($val) {
            return $val * $val;
        }, $vec2)));
        if ($magnitude1 * $magnitude2 == 0) {
            return 0;
        }
        return $dotProduct / ($magnitude1 * $magnitude2);
    }

    // public function detail_rekomendasi(LowonganPekerjaan $loker)
    // {
    //     $perusahaan = Perusahaan::all();
    //     $rekomendasi = DB::table('rekomendasilowongans as rks')
    //         ->join('lokers as lk', 'rks.loker_id', '=', 'lk.id')
    //         ->join('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
    //         ->select(
    //             'lk.id',
    //             'rks.id',
    //             'lk.nama_loker',
    //             'lk.persyaratan',
    //             'lk.deskripsi',
    //             'lk.gaji_bawah',
    //             'lk.gaji_atas',
    //             'lk.tipe_pekerjaan',
    //             'lk.tgl_tutup',
    //             'lk.keahlian',
    //             'lk.kuota',
    //             'lk.keahlian',
    //             'ps.nama_pemilik',
    //             'ps.nama_perusahaan',
    //             'ps.logo_perusahaan',
    //             'ps.email_perusahaan',
    //             'ps.alamat_perusahaan',
    //             'ps.deskripsi',
    //             'ps.no_telp',
    //             'ps.website',
    //             'ps.email_perusahaan',
    //         )
    //         ->first();

    //     return view('showAllJobs', [
    //         'perusahaan' => $perusahaan,
    //         'rekomendasi' => $rekomendasi,
    //     ]);
    // }


    public function show(LowonganPekerjaan $loker)
    {
        $perusahaan = Perusahaan::all();

        $getLamarPending = Lamar::select(
            'lamars.loker_id',
            'lamars.status'
        )
            ->where('loker_id', $loker->id)
            ->where('status', 'Pending')
            ->count();
        $getLamarDiterima = Lamar::select(
            'lamars.loker_id',
            'lamars.status'
        )
            ->where('loker_id', $loker->id)
            ->where('status', 'Diterima')
            ->count();
        // dd($getLamarDiterima);

        $updatedDiff = $loker->updated_at->diffInSeconds(now());

        if ($updatedDiff < 60) {
            $updatedAgo = $updatedDiff . ' detik yang lalu';
        } elseif ($updatedDiff < 3600) {
            $updatedAgo = floor($updatedDiff / 60) . ' menit yang lalu';
        } elseif ($updatedDiff < 86400) {
            $updatedAgo = floor($updatedDiff / 3600) . ' jam yang lalu';
        } else {
            $updatedAgo = $loker->updated_at->diffInDays(now()) . ' hari yang lalu';
        }
        // Mengecek apakah user sudah melamar untuk loker ini
        $hasApplied = false;
        $lamaranStatus = null;

        if (Auth::check() && Auth::user()->lulusan) {
            $lamaran = Lamar::where('loker_id', $loker->id)->where('user_id', Auth::user()->lulusan->id)->first();
            if ($lamaran) {
                $hasApplied = true;
                $lamaranStatus = $lamaran->status;
            }
        }

        // $lamaranStatus = $lamaran ? $lamaran->status : null;

        if (Auth::check()) {
            return view('showAllJobs', [
                'loker' => $loker,
                'perusahaan' => $perusahaan,
                'hasApplied' => $hasApplied,
                'lamaranStatus' => $lamaranStatus,
                'updatedAgo' => $updatedAgo,
                'getLamarPending' => $getLamarPending,
                'getLamarDiterima' => $getLamarDiterima,
            ]);
        } else {
            return view('auth.login');
        }
    }
}
