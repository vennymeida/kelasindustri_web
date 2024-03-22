<?php

namespace App\Http\Controllers;


use App\Models\lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
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
        $perusahaan = Perusahaan::all();
        $stopwords = [
            'adalah', 'saya', 'dalam', 'memiliki', 'biasa', 'menguasai', 'mampu', 'di', 'lulusan', 'pengalaman', 'keterampilan', 'dan', 'selama', 'aku', 'bulan', 'lain', 'sebagainya', 'mampu',
            'jurusan', 'sebagainya', 'keahlian', 'bidang', 'pembuatan', 'khususnya', 'magang', 'pada', 'posisi', '6', 'bisa', 'ke'
        ];

        $lulusanData = DB::table('lulusans')->select('id', 'ringkasan')->get();
        $lokerData = DB::table('lokers')->select('id', 'persyaratan', 'deskripsi', 'keahlian', 'tipe_pekerjaan', 'lokasi')->get();

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
            $loker->tf = $processTextAndCalculateTF($loker->persyaratan . ' ' . $loker->deskripsi . ' ' . $loker->keahlian . ' ' . $loker->tipe_pekerjaan);
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

        $allResults = DB::table('rekomendasilowongans as rks')
            ->join('lulusans as ls', 'rks.lulusan_id', '=', 'ls.id')
            ->join('lokers as lk', 'rks.loker_id', '=', 'lk.id')
            ->join('users as u', 'ls.user_id', '=', 'u.id')
            ->join('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
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
                'ls.ringkasan',
                'u.email',
                'u.name',
                'ps.nama_pemilik',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
                'rks.score_similarity'
            )
            ->where('rks.score_similarity', '>', 0)
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
                'ps.nama_pemilik',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
            )->when($request->input('nama_loker'), function ($query, $judul) {
                return $query->where('lk.nama_loker', 'like', '%' . $judul . '%');
            })
            ->when($request->input('persyaratan'), function ($query, $name) {
                return $query->where('lk.persyaratan', 'like', '%' . $name . '%');
            })
            ->paginate(10);

        return view('all-jobs', ['perusahaan' => $perusahaan, 'allResults' => $allResults, 'lokers' => $lokerData, 'lulusan' => $lulusanData, 'tableloker' => $tableloker]);
    }


    // protected function processTextAndCalculateTF($text)
    // {
    //     $stopwords = [
    //         'adalah', 'saya', 'dalam', 'memiliki', 'biasa', 'menguasai', 'mampu', 'di', 'lulusan', 'pengalaman', 'keterampilan', 'dan', 'selama', 'aku', 'bulan', 'lain', 'sebagainya', 'mampu',
    //         'jurusan', 'sebagainya', 'keahlian', 'bidang', 'pembuatan', 'khususnya', 'magang', 'pada', 'posisi', '6', 'bisa', 'ke'
    //     ];
    //     // Mengonversi teks ke huruf kecil untuk menghilangkan case sensitivity
    //     $textLower = strtolower($text);
    //     // Tokenisasi: Memecah teks menjadi kata-kata dengan menghilangkan tanda baca
    //     $textWithoutPunctuation = preg_replace('/[^\w\s]/', '', $textLower);
    //     // Menghilangkan stopwords
    //     $textWithoutStopWords = $this->stopWordRemover->remove($textWithoutPunctuation);
    //     // Memecah teks menjadi kata-kata setelah menghilangkan stopwords
    //     $wordsArray = explode(' ', $textWithoutStopWords);
    //     $filteredWords = array_filter($wordsArray, function ($word) use ($stopwords) {
    //         return !in_array($word, $stopwords) && !empty($word);
    //     });
    //     return $this->calculateTF($filteredWords);
    // }



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

    public function detail_rekomendasi(LowonganPekerjaan $loker)
    {
        $perusahaan = Perusahaan::all();
        $rekomendasi = DB::table('rekomendasilowongans as rks')
            ->join('lokers as lk', 'rks.loker_id', '=', 'lk.id')
            ->join('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
            ->select(
                'lk.id',
                'rks.id',
                'lk.nama_loker',
                'lk.persyaratan',
                'lk.deskripsi',
                'lk.gaji_bawah',
                'lk.gaji_atas',
                'lk.tipe_pekerjaan',
                'lk.tgl_tutup',
                'lk.keahlian',
                'lk.kuota',
                'lk.keahlian',
                'ps.nama_pemilik',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
                'ps.no_telp',
                'ps.website',
                'ps.email_perusahaan',
            )
            ->first();

        return view('showAllJobs', [
            'perusahaan' => $perusahaan,
            'rekomendasi' => $rekomendasi,
        ]);
    }


    public function show(Request $request)
    {
        $perusahaan = Perusahaan::all();
        $rekomendasi = DB::table('lokers as lk')
            ->join('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
            ->select(
                'lk.id',
                'lk.nama_loker',
                'lk.persyaratan',
                'lk.deskripsi',
                'lk.gaji_atas',
                'lk.gaji_bawah',
                'lk.tipe_pekerjaan',
                'lk.tgl_tutup',
                'lk.keahlian',
                'lk.kuota',
                'ps.nama_pemilik',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
                'ps.no_telp',
                'ps.email_perusahaan',
                'ps.website',
            )
            ->first();

        return view('showAllJobs', [
            'perusahaan' => $perusahaan,
            'rekomendasi' => $rekomendasi,
        ]);
    }
}

//     public function show(LowonganPekerjaan $loker)
//     {
//         $perusahaan = Perusahaan::all();
//         $getLamarPending = lamar::select(
//             'lamars.id_loker',
//             'lamars.status'
//         )
//             ->where('id_loker', $loker->id)
//             ->where('status', 'Pending')
//             ->count();
//         $getLamarDiterima = lamar::select(
//             'lamars.id_loker',
//             'lamars.status'
//         )
//             ->where('id_loker', $loker->id)
//             ->where('status', 'Diterima')
//             ->count();
//         // dd($getLamarDiterima);

//         $updatedDiff = $loker->updated_at->diffInSeconds(now());

//         if ($updatedDiff < 60) {
//             $updatedAgo = $updatedDiff . ' detik yang lalu';
//         } elseif ($updatedDiff < 3600) {
//             $updatedAgo = floor($updatedDiff / 60) . ' menit yang lalu';
//         } elseif ($updatedDiff < 86400) {
//             $updatedAgo = floor($updatedDiff / 3600) . ' jam yang lalu';
//         } else {
//             $updatedAgo = $loker->updated_at->diffInDays(now()) . ' hari yang lalu';
//         }

//         $hasApplied = $loker->hasApplied;
//         // Mengecek apakah user sudah melamar untuk loker ini
//         $lamaran = null;

//         if (Auth::check()) {
//             // Check if user has a profile before attempting to access the profile's id.
//             if (Auth::user()->profile) {
//                 $lamaran = Lamar::where('id_loker', $loker->id)
//                     ->where('id_lulusan', Auth::user()->id)
//                     ->first();
//             }
//             // If the user doesn't have a profile or isn't authenticated, $lamaran will remain null.
//         }

//         $lamaranStatus = $lamaran ? $lamaran->status : null;

//         if (Auth::check()) {
//             return view('showAllJobs', [
//                 'loker' => $loker,
//                 'perusahaan' => $perusahaan,
//                 'hasApplied' => $hasApplied,
//                 'lamaranStatus' => $lamaranStatus,
//                 'updatedAgo' => $updatedAgo,
//                 'getLamarPending' => $getLamarPending,
//                 'getLamarDiterima' => $getLamarDiterima,
//             ]);
//         } else {
//             return view('auth.login');
//         }
//     }
// }
