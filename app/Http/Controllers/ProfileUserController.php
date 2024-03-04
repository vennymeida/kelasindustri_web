<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileUserRequest;
use App\Models\Keahlian;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Lulusan;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use App\Models\Pelatihan;
use App\Models\Perusahaan;
use App\Models\ProfileUser;
use App\Models\Postingan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileUserController extends Controller
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

    public function index(Request $request)
    {
        $userId = Auth::id();
        // $postingans = Postingan::select('postingans.*')
        //     ->where('user_id', $userId)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(3);
        // $pendidikans = Pendidikan::select('pendidikan.*')
        //     ->where('user_id', $userId)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(2);
        // $pengalamans = Pengalaman::select('pengalaman.*')
        //     ->where('user_id', $userId)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(2);
        // $pelatihans = Pelatihan::select('pelatihan.*')
        //     ->where('user_id', $userId)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(2);

        // foreach ($postingans as $time) {
        //     $time->timeAgo = $this->getTimeAgo($time->updated_at);
        // }

        $records = Lulusan::all();
        foreach ($records as $record) {
            $ringkasan = implode('-', [
                $record->pelatihan_id,
                $record->postingan_id,
                $record->portofolio_id,
                $record->keahlian_id,
                $record->pendidikan_id,
                $record->pengalaman_id,
                $record->lamaran_id,
            ]);

            $record->update(['ringkasan' => $ringkasan]);
        }

        // return view('profile.index')->with([
        //     'postingans' => $postingans,
        //     'pendidikans' => $pendidikans,
        //     'pengalamans' => $pengalamans,
        //     'pelatihans' => $pelatihans,
        // ]);
        return view('profile.index');
    }

    public function profile(ProfileUser $profileUser)
    {
        $userId = Auth::id();

        $keahlians = Keahlian::all();
        $perusahaans = Perusahaan::where('user_id', $userId)->first();
        $postingans = Postingan::select('postingans.*')
            ->where('user_id', $userId)
            ->get();
        $pendidikans = Pendidikan::select('pendidikan.*')
            ->where('user_id', $userId)
            ->get();
        $pengalamans = Pengalaman::select('pengalaman.*')
            ->where('user_id', $userId)
            ->get();
        $pelatihans = Pelatihan::select('pelatihan.*')
            ->where('user_id', $userId)
            ->get();
        $selectedKeahlians = auth()
            ->user()
            ->keahlians->pluck('id')
            ->toArray();

        return view('profile.edit')->with([

            'profileUser' => $profileUser,
            'perusahaans' => $perusahaans,
            'postingans' => $postingans,
            'pendidikans' => $pendidikans,
            'pengalamans' => $pengalamans,
            'pelatihans' => $pelatihans,
            'keahlians' => $keahlians,
            'selectedKeahlians' => $selectedKeahlians,
        ]);
    }




    public function update(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'alamat' => 'nullable|string|max:255',
                    'jenis_kelamin' => 'nullable|in:L,P',
                    'no_hp' => ['nullable', 'regex:/^08[0-9]{8,13}$/', 'min:11', 'max:13'],
                    'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'resume' => 'nullable|file|mimes:pdf|max:2048',
                    'tgl_lahir' => 'nullable|date:d/m/Y',
                    'ringkasan' => 'nullable',
                    'harapan_gaji' => 'nullable|string',
                ],
                [
                    'alamat.max' => 'Alamat Melebihi Batas Maksimal',
                    'jenis_kelamin.in' => 'Jenis Kelamin Hanya Pada Pilihan L/P',
                    'no_hp' => ['regex: Nomor Hp Tidak Sesuai Format'],
                    'no_hp.regex' => 'Nomor Hp Tidak Sesuai Format',
                    'no_hp.min' => 'Digit Nomor Hp Kurang Dari Batas Minimal',
                    'no_hp.max' => 'Digit Nomor Hp Melebihi Batas Maksimal',
                    'foto.image' => 'Foto Tidak Sesuai Format',
                    'foto.mimes' => 'Foto Hanya Mendukung Format jpeg, png, jpg',
                    'foto.max' => 'Ukuran Foto Terlalu Besar',
                    'resume.mimes' => 'Resume Hanya Mendukung Format pdf',
                    'resume.max' => 'Ukuran Resume Terlalu Besar',
                    'tgl_lahir.date' => 'Tanggal Lahir Harus Sesuai Format',
                    // 'ringkasan.max' => 'Ringkasan Melebihi Batas Maksimal',
                    'harapan_gaji.string' => 'Harapan Gaji Harus Angka',
                ],
            );

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terdapat kesalahan dalam pengisian form.');
            }

            $fotoLama = DB::table('profile_users')
                ->where('user_id', Auth::user()->id)
                ->first();
            $user = $request->user();
            $user->profile()->update($request->except('_token', '_method', 'foto', 'resume', 'show_resume', 'show_foto'));
            $profileUser = DB::table('profile_users')
                ->where('user_id', Auth::user()->id)
                ->first();
            $profileUserBaru = new \App\Models\ProfileUser();
            $profileUserBaru->user_id = Auth::user()->id;
            if ($profileUser === null) {
                $profileUserBaru->alamat = $request->input('alamat');
                $profileUserBaru->jenis_kelamin = $request->input('jenis_kelamin');
                $profileUserBaru->no_hp = $request->input('no_hp');
                $profileUserBaru->tgl_lahir = $request->input('tgl_lahir');
                $profileUserBaru->ringkasan = $request->input('ringkasan');
                $profileUserBaru->harapan_gaji = $request->input('harapan_gaji');
                $profileUserBaru->save();
            }

            if ($request->hasFile('foto')) {
                $photo = $request->file('foto');
                $oriName = $photo->getClientOriginalExtension();

                $namaGambar = uniqid() . '.' . $oriName;
                // Storage::putFileAs('public/database/profile/', $photo, $namaGambar);
                Storage::putFileAs('public/profile/', $photo, $namaGambar);

                if ($user->profile === null) {
                    $user->profile = new \App\Models\ProfileUser();
                }

                if ($user->profile->foto) {
                    Storage::delete('public/' . $user->profile->foto);
                }

                // $user->profile->foto = 'database/profile/' . $namaGambar;
                $user->profile->foto = 'profile/' . $namaGambar;
                $user->profile->save();
            } else {
                if ($user->profile && $user->profile->foto !== null) {
                    $user->profile->foto = $user->profile->foto;
                } else {
                    if ($user->profile === null) {
                        $user->profile->foto = asset('assets/img/avatar/avatar-1.png');
                    }
                }
                $user->profile->save();
            }

            if ($request->hasFile('resume')) {
                $resume = $request->file('resume');
                $oriName = $resume->getClientOriginalExtension();

                $namaResume = uniqid() . '.' . $oriName;
                // Storage::putFileAs('public/database/resume/', $resume, $namaResume);
                Storage::putFileAs('public/resume/', $resume, $namaResume);

                if ($user->profile === null) {
                    $user->profile = new \App\Models\ProfileUser();
                }

                if ($user->profile->resume) {
                    Storage::delete('public/' . $user->profile->resume);
                }

                // $user->profile->resume = 'database/resume/' . $namaResume;
                $user->profile->resume = 'resume/' . $namaResume;
                $user->profile->save();
            } else {
                if ($user->profile && $user->profile->resume !== null) {
                    $user->profile->resume = $user->profile->resume;
                } else {
                    if ($user->profile === null) {
                        $user->profile->resume = asset('assets/img/avatar/avatar-1.png');
                    }
                }
                $user->profile->save();
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

    public function destroy(Postingan $profile)
    {
        // Hapus gambar dari penyimpanan sebelum menghapus profil (atau postingan)
        if ($profile->media) {
            Storage::disk('public')->delete($profile->media);
        }

        $profile->delete();

        return redirect()->route('profile.index')->with('success', 'success-delete');
    }
}
