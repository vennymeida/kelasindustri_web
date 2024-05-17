<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\StopWordRemover\StopWordRemoverFactory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

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

            $keahliansData = DB::table('keahlians')
                ->select('id', 'keahlian')
                ->where('user_id', $user->id)
                ->get();

            $lokerData = DB::table('lokers')
                ->select('id', 'persyaratan', 'deskripsi', 'keahlian')
                ->where('status', 'dibuka')
                ->get();

            // Fungsi untuk memproses teks dan menghitung TF untuk setiap dokumen
            if ($lulusanData[0]->ringkasan != null || !$keahliansData->isEmpty()) {
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
                if (!empty($lulusanData) && $lulusanData[0]->ringkasan != null) {
                    foreach ($lulusanData as $lulusan) {
                        $lulusan->tf = $processTextAndCalculateTF($lulusan->ringkasan);
                    }
                } else {
                    // foreach ($lulusanData as $lulusan) {
                    //     $lulusan->tf = $processTextAndCalculateTF([]);
                    // }
                }

                foreach ($lokerData as $loker) {
                    $loker->tf = $processTextAndCalculateTF($loker->persyaratan . ' ' . $loker->deskripsi . ' ' . $loker->keahlian);
                }

                foreach ($keahliansData as $keahlian) {
                    $keahlian->tf = $processTextAndCalculateTF($keahlian->keahlian);
                }
                // Mengolah data lulusan dan loker, dan menghitung TF untuk setiap dokumen



                // Mengumpulkan semua dokumen untuk menghitung IDF
                $allDocuments1 = $lulusanData->merge($lokerData);
                $allDocuments2 = $keahliansData->merge($lokerData);
                if (!empty($lulusanData) && $lulusanData[0]->ringkasan != null) {
                    $idfLulusan  = $this->calculateIDF($allDocuments1->pluck('tf')->toArray());
                    foreach ($lulusanData as $lulusan) {
                        $lulusan->tfidf = $this->calculateTFIDF($lulusan->tf, $idfLulusan);
                    }
                } else {
                    $idfLulusan = [];
                }
                $idfKeahlian = $this->calculateIDF($allDocuments2->pluck('tf')->toArray());

                // Menghitung TF-IDF

                foreach ($keahliansData as $keahlian) {
                    $keahlian->tfidf = $this->calculateTFIDF($keahlian->tf, $idfKeahlian);
                    // dump($lulusan);
                }
                foreach ($lokerData as $loker) {
                    $loker->tfidf = $this->calculateTFIDF($loker->tf, $idfLulusan);
                    $loker->tfidf = $this->calculateTFIDF($loker->tf, $idfKeahlian);
                    // dump($loker);
                }
                // die();

                // Menghitung cosine similarity
                // Menghitung cosine similarity
                // dd($lokerData);
                $rekomendasi = [];

                // Jika salah satu dari lulusanData atau keahliansData kosong, gunakan array kosong
                $lulusanData = $lulusanData ?? [];
                $keahliansData = $keahliansData ?? [];
                $lokerData = $lokerData ?? [];

                // Perulangan utama untuk menghitung similarity dan menyimpan rekomendasi
                foreach ($lokerData as $loker) {
                    foreach ($lulusanData as $lulusan) {
                        if (isset($lulusan->tfidf) && isset($loker->tfidf)) {
                            // Menghitung similarity antara lulusan dan loker
                            $similarityLulusanLoker = $this->calculateCosineSimilarity($lulusan->tfidf, $loker->tfidf);

                            // Menyimpan hasil dalam array rekomendasi
                            $rekomendasi[] = [
                                'lulusan_id' => $lulusan->id,
                                'keahlian_id' => null,
                                'loker_id' => $loker->id,
                                'score_similarity_lulusan' => $similarityLulusanLoker,
                                'score_similarity_keahlian' => 0,
                            ];
                        }
                    }

                    foreach ($keahliansData as $keahlian) {
                        if (isset($keahlian->tfidf) && isset($loker->tfidf)) {
                            // Menghitung similarity antara keahlian dan loker
                            $similarityKeahlianLoker = $this->calculateCosineSimilarity($keahlian->tfidf, $loker->tfidf);

                            // Menyimpan hasil dalam array rekomendasi
                            $rekomendasi[] = [
                                'lulusan_id' => null,
                                'keahlian_id' => $keahlian->id,
                                'loker_id' => $loker->id,
                                'score_similarity_lulusan' => 0,
                                'score_similarity_keahlian' => $similarityKeahlianLoker,
                            ];
                        }
                    }

                    // Jika kedua lulusanData dan keahliansData ada, gabungkan hasil similarity
                    foreach ($lulusanData as $lulusan) {
                        foreach ($keahliansData as $keahlian) {
                            if (isset($lulusan->tfidf) && isset($keahlian->tfidf) && isset($loker->tfidf)) {
                                // Menghitung similarity antara lulusan dan loker
                                $similarityLulusanLoker = $this->calculateCosineSimilarity($lulusan->tfidf, $loker->tfidf);
                                // Menghitung similarity antara keahlian dan loker
                                $similarityKeahlianLoker = $this->calculateCosineSimilarity($keahlian->tfidf, $loker->tfidf);

                                // Menyimpan hasil dalam array rekomendasi
                                $rekomendasi[] = [
                                    'lulusan_id' => $lulusan->id,
                                    'keahlian_id' => $keahlian->id,
                                    'loker_id' => $loker->id,
                                    'score_similarity_lulusan' => $similarityLulusanLoker,
                                    'score_similarity_keahlian' => $similarityKeahlianLoker,
                                ];
                            }
                        }
                    }
                }

                // dd($rekomendasi);
                // dd($keahliansData);

                DB::transaction(function () use ($lulusanData, $lokerData, $keahliansData) {
                    // Menghapus dan memasukkan data baru untuk lulusan
                    if (!empty($lulusanData) && $lulusanData[0]->ringkasan != null) {
                        foreach ($lulusanData as $lulusan) {
                            DB::table('rekomendasis_lulusan')->where('document_id', $lulusan->id)->delete();
                            foreach ($lulusan->tf as $word => $tfValue) {
                                DB::table('rekomendasis_lulusan')->insert([
                                    'document_id' => $lulusan->id,
                                    'word' => $word,
                                    'document_type' => 'lulusan',
                                    'tf_value' => $tfValue,
                                    'tfidf_value' => $lulusan->tfidf[$word] ?? 0,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);
                            }
                        }
                    }

                    // Menghapus dan memasukkan data baru untuk loker
                    foreach ($lokerData as $loker) {
                        DB::table('rekomendasis_loker')->where('document_id', $loker->id)->delete();
                        foreach ($loker->tf as $word => $tfValue) {
                            DB::table('rekomendasis_loker')->insert([
                                'document_id' => $loker->id,
                                'word' => $word,
                                'document_type' => 'loker',
                                'tf_value' => $tfValue,
                                'tfidf_value' => $loker->tfidf[$word] ?? 0,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }

                    // Menghapus dan memasukkan data baru untuk keahlian
                    foreach ($keahliansData as $keahlian) {
                        DB::table('rekomendasis_keahlian')->where('document_id', $keahlian->id)->delete();
                        foreach ($keahlian->tf as $word => $tfValue) {
                            DB::table('rekomendasis_keahlian')->insert([
                                'document_id' => $keahlian->id,
                                'word' => $word,
                                'document_type' => 'keahlian',
                                'tf_value' => $tfValue,
                                'tfidf_value' => $keahlian->tfidf[$word] ?? 0,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                });



                DB::transaction(function () use ($rekomendasi) {
                    // Mengumpulkan semua lulusan_id dari rekomendasi
                    $lulusanIds = collect($rekomendasi)->pluck('lulusan_id')->unique();

                    // Menghapus semua entri yang terkait dengan setiap lulusan_id
                    foreach ($lulusanIds as $lulusanId) {
                        DB::table('rekomendasilowongans')->where('lulusan_id', $lulusanId)->delete();
                    }

                    // Memasukkan entri baru
                    foreach ($rekomendasi as $item) {
                        DB::table('rekomendasilowongans')->insert([
                            'lulusan_id' => $item['lulusan_id'],
                            'keahlian_id' => $item['keahlian_id'],
                            'loker_id' => $item['loker_id'],
                            'score_similarity_lulusan' => $item['score_similarity_lulusan'],
                            'score_similarity_keahlian' => $item['score_similarity_keahlian'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                });
            }




            // dd($rekomendasi);
            // dd($loker);
            // dd($lulusanData);
            // dd($similarity);
            // dd($lulusan->tfidf = $this->calculateTFIDF($lulusan->tf, $idf));
            // dd($loker->tfidf = $this->calculateTFIDF($loker->tf, $idf));


            $currentDate = Carbon::now();
            $userId = Auth::id();
            $allResults = DB::table('rekomendasilowongans as rks')
                ->leftJoin('lulusans as ls', 'rks.lulusan_id', '=', 'ls.id')
                ->leftJoin('keahlians as ks', 'rks.keahlian_id', '=', 'ks.id')
                ->leftJoin('lokers as lk', 'rks.loker_id', '=', 'lk.id')
                ->leftJoin('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
                ->leftJoin('users as u', 'ls.user_id', '=', 'u.id')
                ->select(
                    'lk.id',
                    'lk.perusahaan_id',
                    'lk.nama_loker',
                    'lk.persyaratan',
                    'lk.deskripsi as loker_deskripsi',
                    'lk.gaji_atas',
                    'lk.gaji_bawah',
                    'lk.tipe_pekerjaan',
                    'lk.tgl_tutup',
                    'lk.kuota',
                    'lk.lokasi',
                    'lk.status',
                    'lk.keahlian as keahlian_loker',
                    'ps.nama_pemilik',
                    'ps.nama_perusahaan',
                    'ps.logo_perusahaan',
                    'ps.email_perusahaan',
                    'ps.alamat_perusahaan',
                    'ps.deskripsi as perusahaan_deskripsi',
                    'ls.user_id',
                    'ks.keahlian',
                    DB::raw('rks.score_similarity_keahlian * 100 as score_similarity_keahlian'),
                    DB::raw('rks.score_similarity_lulusan * 100 as score_similarity_lulusan')

                )->when($request->input('nama_loker'), function ($query, $nama_loker) {
                    return $query->where('lk.nama_loker', 'like', '%' . $nama_loker . '%');
                })
                ->when($request->input('persyaratan'), function ($query, $name) {
                    return $query->where('lk.persyaratan', 'like', '%' . $name . '%');
                })
                ->when($request->input('lokasi'), function ($query, $lokasi) {
                    return $query->where('lk.lokasi', $lokasi);
                })
                ->where('lk.status', 'dibuka')
                ->where('lk.tgl_tutup', '>=', $currentDate);

            if ($lulusanData[0]->ringkasan == null) {
                // dd($allResults->get());
                $allResults = $allResults->where('rks.score_similarity_keahlian', '>', 0);
            } elseif (($keahliansData->isEmpty())) {
                $allResults = $allResults->where('rks.score_similarity_lulusan', '>', 0);
            } else {
                $allResults = $allResults->Where('rks.score_similarity_lulusan', '>', 0)->Where('rks.score_similarity_keahlian', '>', 0);
            }

            $allResults = $allResults->groupBy("lk.id");



            if ($request->has('posisi') && !empty($request->posisi)) {
                $allResults->where('lk.nama_loker', 'like', '%' . $request->posisi . '%');
            }

            if ($request->has('tipe')) {
                $allResults->whereIn('lk.tipe_pekerjaan', $request->input('tipe'));
            }

            // Filter by salary range
            if ($request->has('gaji')) {
                $allResults->where(function ($query) use ($request) {
                    foreach ($request->input('gaji') as $gaji) {
                        switch ($gaji) {
                            case 'less-1jt':
                                $query->orWhere('lk.gaji_atas', '<', 1000000);
                                break;
                            case '1jt-5jt':
                                $query->orWhereBetween('lk.gaji_atas', [1000000, 5000000]);
                                break;
                            case '5jt-10jt':
                                $query->orWhereBetween('lk.gaji_atas', [5000001, 10000000]);
                                break;
                            case 'more-10jt':
                                $query->orWhere('lk.gaji_atas', '>', 10000000);
                                break;
                        }
                    }
                });
            }

            if ($lulusanData[0]->ringkasan == null && $keahliansData->isEmpty()) {
                $allResults = null;
            } else {
                $allResults = $allResults->paginate(4);
            }

            $tableloker = DB::table('lokers as lk')
                ->join('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
                ->select(
                    'lk.id',
                    'lk.perusahaan_id',
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
                ->when($request->input('lokasi'), function ($query, $lokasi) {
                    return $query->where('lk.lokasi', $lokasi);
                })
                ->where('lk.tgl_tutup', '>=', $currentDate)
                ->where('lk.status', 'dibuka');
            if ($request->has('posisi') && !empty($request->posisi)) {
                $tableloker->where('lk.nama_loker', 'like', '%' . $request->posisi . '%');
            }

            if ($request->has('tipe')) {
                $tableloker->whereIn('lk.tipe_pekerjaan', $request->input('tipe'));
            }

            // Filter by salary range
            if ($request->has('gaji')) {
                $tableloker->where(function ($query) use ($request) {
                    foreach ($request->input('gaji') as $gaji) {
                        switch ($gaji) {
                            case 'less-1jt':
                                $query->orWhere('lk.gaji_atas', '<', 1000000);
                                break;
                            case '1jt-5jt':
                                $query->orWhereBetween('lk.gaji_atas', [1000000, 5000000]);
                                break;
                            case '5jt-10jt':
                                $query->orWhereBetween('lk.gaji_atas', [5000001, 10000000]);
                                break;
                            case 'more-10jt':
                                $query->orWhere('lk.gaji_atas', '>', 10000000);
                                break;
                        }
                    }
                });
            }


            $tableloker = $tableloker->paginate(10);

            $lokasikota = DB::table('kotas')->select('id', 'kota')->get();


            return view('all-jobs', ['perusahaan' => $perusahaan, 'allResults' => $allResults, 'lokers' => $lokerData, 'lulusan' => $lulusanData, 'tableloker' => $tableloker, 'lokasikota' => $lokasikota]);
        } else {
            // Jika pengguna belum login, tampilkan semua data loker
            $tableloker = LowonganPekerjaan::where('nama_loker', 'like', '%' . $request->input('posisi') . '%')
                ->when($request->input('nama_loker'), function ($query, $nama_loker) {
                    return $query->where('nama_loker', 'like', '%' . $nama_loker . '%');
                })
                ->when($request->input('persyaratan'), function ($query, $name) {
                    return $query->where('persyaratan', 'like', '%' . $name . '%');
                })
                ->when($request->input('lokasi'), function ($query, $lokasi) {
                    return $query->where('lokasi', $lokasi);
                })
                ->where('status', 'dibuka');
            if ($request->has('tipe')) {
                $tableloker->whereIn('tipe_pekerjaan', $request->input('tipe'));
            }

            // Filter by salary range
            if ($request->has('gaji')) {
                $tableloker->where(function ($query) use ($request) {
                    foreach ($request->input('gaji') as $gaji) {
                        switch ($gaji) {
                            case 'less-1jt':
                                $query->orWhere('gaji_atas', '<', 1000000);
                                break;
                            case '1jt-5jt':
                                $query->orWhereBetween('gaji_atas', [1000000, 5000000]);
                                break;
                            case '5jt-10jt':
                                $query->orWhereBetween('gaji_atas', [5000001, 10000000]);
                                break;
                            case 'more-10jt':
                                $query->orWhere('gaji_atas', '>', 10000000);
                                break;
                        }
                    }
                });
            }


            $tableloker = $tableloker->paginate(10);



            $lokasikota = DB::table('kotas')->select('id', 'kota')->get();
            return view('all-jobs', ['tableloker' => $tableloker, 'lokasikota' => $lokasikota]);
        }
    }

    // rumus
    protected function calculateTF($words)
    {
        $tf = [];
        $countWords = array_count_values($words);
        if (count($countWords) === 0) {
            return $tf; // Return an empty array if there are no words
        }
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
    protected function calculateTFIDF($tfArray, $idfArray)
    {
        $tfidfArray = [];
        foreach ($tfArray as $index => $tf) {
            if (isset($idfArray[$index])) {
                $tfidfArray[$index] = $tf * $idfArray[$index];
            } else {
                $tfidfArray[$index] = 0; // or handle this case appropriately
            }
        }
        return $tfidfArray;
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

        if ($loker->updated_at) {
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
        } else {
            $updatedAgo = 'No update information';
        }
        // Mengecek apakah user sudah melamar untuk loker ini
        $hasApplied = false;
        $lamaranStatus = null;
        $lamaran = null;

        if (Auth::check() && Auth::user()->lulusan) {
            $lamaran = Lamar::where('loker_id', $loker->id)->where('user_id', Auth::user()->lulusan->id)->first();
            if ($lamaran) {
                $hasApplied = true;
                $lamaranStatus = $lamaran->status;
            }
        }

        $lamaranStatus = $lamaran ? $lamaran->status : null;

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
