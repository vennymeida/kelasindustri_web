<?php

namespace App\Http\Controllers;

use App\Models\Lulusan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use App\Models\Pelatihan;
use App\Models\Perusahaan;
use App\Models\Postingan;
use App\Models\Portofolio;
use App\Models\Keahlian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileLulusanController extends Controller
{
    public function getTimeAgo($timestamp)
    {
        $currentTime = Carbon::now();
        $timeDiff = $currentTime->diffInSeconds($timestamp);

        if ($timeDiff < 60) {
            return "Tayang {$timeDiff} detik yang lalu";
        } elseif ($timeDiff < 3600) {
            $minutes = floor($timeDiff / 60);
            return "Tayang {$minutes} menit yang lalu";
        } elseif ($timeDiff < 86400) {
            $hours = floor($timeDiff / 3600);
            return "Tayang {$hours} jam yang lalu";
        } else {
            $days = floor($timeDiff / 86400);
            return "Tayang {$days} hari yang lalu";
        }
    }

    public function index()
    {
        // Logika untuk menampilkan profil perusahaan
        $lulusan = auth()->user()->lulusan;
        $userId = Auth::id();
        $keahlians = Keahlian::all();
        $postingans = Postingan::select('postingans.*')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        $pendidikans = Pendidikan::select('pendidikans.*')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $pengalamans = Pengalaman::select('pengalamans.*')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $pelatihans = Pelatihan::select('pelatihans.*')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $portofolios = DB::table('portofolios')->select('portofolios.id', 'portofolios.nama_portofolio', 'portofolios.dokumen_portofolio', 'portofolios.link_portofolio')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        // dd($portofolios->id);

        return view('profile.index')->with([
            'lulusan' => $lulusan,
            'postingans' => $postingans,
            'pendidikans' => $pendidikans,
            'pengalamans' => $pengalamans,
            'pelatihans' => $pelatihans,
            'portofolios' => $portofolios,
            'keahlians' => $keahlians,
        ]);
    }



    public function create()
    {
        $userid = Auth::id();
        $user = DB::table('users')->select('users.id', 'users.email', 'users.name')->where('id', $userid)->first();
        return view('profile.create-lulusan', ['user' => $user]);
    }

    public function edit(Lulusan $profile_lulusan)
    {
        $userId = Auth::id();
        $perusahaans = Perusahaan::where('user_id', $userId)->first();
        $postingans = Postingan::select('postingans.*')
            ->where('user_id', $userId)
            ->get();
        $pendidikans = Pendidikan::select('pendidikans.*')
            ->where('user_id', $userId)
            ->get();
        $pengalamans = Pengalaman::select('pengalamans.*')
            ->where('user_id', $userId)
            ->get();
        $pelatihans = Pelatihan::select('pelatihans.*')
            ->where('user_id', $userId)
            ->get();
        $portofolios = Portofolio::select('portofolios.*')
            ->where('user_id', $userId)
            ->get();

        return view('profile.edit')->with([
            'lulusan' => $profile_lulusan,
            'perusahaans' => $perusahaans,
            'postingans' => $postingans,
            'pendidikans' => $pendidikans,
            'pengalamans' => $pengalamans,
            'pelatihans' => $pelatihans,
            'portofolios' => $portofolios,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan, kosong',
            'alamat' => 'required',
            'angkatan_tahun' => 'required',
            'divisi' => 'required',
            'ringkasan' => 'nullable',
            'no_hp' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'resume' => 'nullable|mimes:pdf|max:2048',
            'tgl_lahir' => 'nullable|date',
        ]);

        $userId = Auth::id();

        $lulusan = new Lulusan();
        $lulusan->user_id = $userId;
        $lulusan->status = $request->status;
        $lulusan->alamat = $request->alamat;
        $lulusan->jenis_kelamin = $request->jenis_kelamin;
        $lulusan->no_hp = $request->no_hp;
        $lulusan->angkatan_tahun = $request->angkatan_tahun;
        $lulusan->divisi = $request->divisi;
        $lulusan->ringkasan = $request->ringkasan ?? null;
        $lulusan->foto = $request->foto ?? null;
        $lulusan->resume = $request->resume ?? null;
        $lulusan->tgl_lahir = $request->tgl_lahir ?? null;
        $lulusan->save();

        return redirect()->route('profile-lulusan.index')->with('success', 'Profile berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'alamat' => 'nullable|string|max:255',
                    'jenis_kelamin' => 'nullable|in:laki-laki,perempuan, kosong',
                    'status' => [
                        'nullable',
                        Rule::in(['Aktif Mencari Kerja', 'Sudah Bekerja', 'Melanjutkan Kuliah']),
                    ],
                    'no_hp' => ['nullable', 'regex:/^08[0-9]{8,13}$/', 'min:11', 'max:13'],
                    'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'resume' => 'nullable|file|mimes:pdf|max:2048',
                    'tgl_lahir' => 'nullable|date:d/m/Y',
                    'ringkasan' => 'nullable',
                    'angkatan_tahun' => 'required|regex:/^[0-9]{4}$/',
                    'divisi' => 'required|',
                ],
                [
                    'alamat.max' => 'Alamat Melebihi Batas Maksimal',
                    'jenis_kelamin.in' => 'Jenis Kelamin Hanya Pada Pilihan L/P',
                    'status.in' => 'Status Hanya Pada Pilihan',
                    'no_hp.regex' => 'Nomor Hp Tidak Sesuai Format',
                    'no_hp.min' => 'Digit Nomor Hp Kurang Dari Batas Minimal',
                    'no_hp.max' => 'Digit Nomor Hp Melebihi Batas Maksimal',
                    'foto.image' => 'Foto Tidak Sesuai Format',
                    'foto.mimes' => 'Foto Hanya Mendukung Format jpeg, png, jpg',
                    'foto.max' => 'Ukuran Foto Terlalu Besar',
                    'resume.mimes' => 'Resume Hanya Mendukung Format pdf',
                    'resume.max' => 'Ukuran Resume Terlalu Besar',
                    'tgl_lahir.date' => 'Tanggal Lahir Harus Sesuai Format',
                ],
            );

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terdapat kesalahan dalam pengisian form.');
            }

            $user = Auth::user(); // Menggunakan user yang sedang login

            // Update profile user
            $profile = $user->lulusan; // Menggunakan relasi lulusan pada model User

            // Update status
            $profile->status = $request->status;
            $profile->jenis_kelamin = $request->jenis_kelamin; // Pastikan ini ada
            $profile->ringkasan = $request->ringkasan;
            $profile->alamat = $request->alamat;
            $profile->no_hp = $request->no_hp;
            $profile->angkatan_tahun = $request->angkatan_tahun;
            $profile->divisi = $request->divisi;
            $profile->tgl_lahir = $request->tgl_lahir;

            // Simpan perubahan ke dalam database
            $profile->save();

            // Update foto profile
            if ($request->hasFile('foto')) {
                // Dapatkan path foto lama
                $oldFotoPath = $profile->foto;

                // Simpan foto yang baru
                $foto = $request->file('foto');
                $fotoPath = $foto->store('foto', 'public');
                $profile->foto = $fotoPath;
                $profile->save();

                // Hapus foto lama dari storage
                if ($oldFotoPath) {
                    Storage::disk('public')->delete($oldFotoPath);
                }
            }


            // Update resume
            if ($request->hasFile('resume')) {
                $resume = $request->file('resume');
                $resumePath = $resume->store('public/resume');
                $profile->resume = $resumePath;
                $profile->save();
            }

            return redirect()
                ->back()
                ->with('success', 'Profile berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan. Profil tidak dapat disimpan.');
        }
    }
}
