<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePerusahaanRequest;
use App\Models\Perusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    public function update(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'pemilik' => 'nullable|string|max:255',
                    'nama' => 'nullable|string|max:255',
                    'alamat_perusahaan' => 'nullable|string|max:255',
                    'kecamatan_id' => 'nullable',
                    'kelurahan_id' => 'nullable',
                    'email' => 'nullable|string|max:255',
                    'website' => 'nullable|string|max:255',
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'no_hp_perusahaan' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',
                    'deskripsi' => 'nullable',
                    'surat_mou' => 'nullable|file|mimes:pdf|max:2048',
                ],
                [
                    'pemilik.max' => 'Nama Pemilik Melebihi Batas Maksimal',
                    'nama.max' => 'Nama Perusahaan Melebihi Batas Maksimal',
                    'alamat_perusahaan.max' => 'Alamat Melebihi Batas Maksimal',
                    'kecamatan_id.exists' => 'Kecamatan tidak valid.',
                    'kelurahan_id.exists' => 'Kelurahan tidak valid.',
                    'email.max' => 'Email Melebihi Batas Maksimal',
                    'website.max' => 'Website Melebihi Batas Maksimal',
                    'logo.image' => 'Logo Tidak Sesuai Format',
                    'logo.mimes' => 'Logo Hanya Mendukung Format jpeg, png, jpg',
                    'logo.max' => 'Ukuran Logo Terlalu Besar',
                    'no_hp_perusahaan.regex' => 'Nomor Hp Tidak Sesuai Format',
                    // 'deskripsi.max' => 'Deskripsi Melebihi Batas Maksimal',
                    'surat_mou.mimes' => 'Surat MoU Hanya Mendukung Format pdf',
                    'surat_mou.max' => 'Ukuran MoU Terlalu Besar',
                ],
            );

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terdapat kesalahan dalam pengisian form.');
            }

            $fotoLama = DB::table('perusahaan')
                ->where('user_id', Auth::user()->id)
                ->first();
            $user = $request->user();
            $user->perusahaan()->update($request->except('_token', '_method', 'logo', 'siu', 'show_siu', 'show_logo'));
            $perusahaanUser = DB::table('perusahaan')
                ->where('user_id', Auth::user()->id)
                ->first();
            $perusahaanUserBaru = new \App\Models\Perusahaan();
            $perusahaanUserBaru->user_id = Auth::user()->id;

            if ($perusahaanUser === null) {
                $perusahaanUserBaru->pemilik = $request->input('pemilik');
                $perusahaanUserBaru->nama = $request->input('nama');
                $perusahaanUserBaru->alamat_perusahaan = $request->input('alamat_perusahaan');
                $perusahaanUserBaru->email = $request->input('email');
                $perusahaanUserBaru->website = $request->input('website');
                $perusahaanUserBaru->no_hp_perusahaan = $request->input('no_hp_perusahaan');
                $perusahaanUserBaru->deskripsi = $request->input('deskripsi');
                $perusahaanUserBaru->kecamatan_id = $request->input('kecamatan_id');
                $perusahaanUserBaru->kelurahan_id = $request->input('kelurahan_id');
                $perusahaanUserBaru->save();
            }

            if ($request->hasFile('logo')) {
                $photo = $request->file('logo');
                $oriName = $photo->getClientOriginalExtension();

                $namaGambar = uniqid() . '.' . $oriName;
                // Storage::putFileAs('public/database/perusahaan/', $photo, $namaGambar);
                Storage::putFileAs('public/perusahaan/', $photo, $namaGambar);

                if ($user->perusahaan === null) {
                    $user->perusahaan = new \App\Models\Perusahaan();
                }

                if ($user->perusahaan->logo) {
                    Storage::delete('public/' . $user->perusahaan->logo);
                }

                // $user->perusahaan->logo = 'database/perusahaan/' . $namaGambar;
                $user->perusahaan->logo = 'perusahaan/' . $namaGambar;
                $user->perusahaan->save();
            } else {
                if ($user->perusahaan && $user->perusahaan->logo !== null) {
                    $user->perusahaan->logo = $user->perusahaan->logo;
                } else {
                    if ($user->perusahaan === null) {
                        $user->perusahaan->logo = asset('assets/img/avatar/avatar-1.png');
                    }
                }
                $user->perusahaan->save();
            }

            if ($request->hasFile('siu')) {
                $siu = $request->file('siu');
                $oriName = $siu->getClientOriginalExtension();

                $namaSiu = uniqid() . '.' . $oriName;
                // Storage::putFileAs('public/database/siu/', $siu, $namaSiu);
                Storage::putFileAs('public/siu/', $siu, $namaSiu);

                if ($user->perusahaan === null) {
                    $user->perusahaan = new \App\Models\Perusahaan();
                }

                if ($user->perusahaan->siu) {
                    Storage::delete('public/' . $user->perusahaan->siu);
                }

                // $user->perusahaan->siu = 'database/siu/' . $namaSiu;
                $user->perusahaan->siu = 'siu/' . $namaSiu;
                $user->perusahaan->save();
            } else {
                if ($user->perusahaan && $user->perusahaan->siu !== null) {
                    $user->perusahaan->siu = $user->perusahaan->siu;
                } else {
                    if ($user->perusahaan === null) {
                        $user->perusahaan->surat_mou = asset('assets/img/avatar/avatar-1.png');
                    }
                }
                $user->perusahaan->save();
            }

            return redirect()
                ->back()
                ->with('success', 'Data perusahaan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan. Data perusahaan tidak dapat disimpan.');
        }
    }
}
