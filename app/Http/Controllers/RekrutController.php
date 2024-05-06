<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Models\Lulusan;
use App\Http\Requests\StorelamarRequest;
use App\Http\Requests\UpdatelamarRequest;
use App\Mail\InterviewInvitation;
use App\Mail\SendEmailPelamar;
use App\Mail\SendRecuit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RekrutController extends Controller
{
    public function rekrut(Request $request, Lulusan $user)
    {
        $request->validate([
            'loker_id' => 'required|exists:lokers,id',
            'subject' => 'nullable|string|max:255',
            'tempat_interview' => 'nullable|string|max:255',
            'tanggal_interview' => 'nullable|date',
            'catatan' => 'nullable|string',
        ]);

        $lamar = Lamar::create([
            'email' => $request->email,
            'loker_id' => $request->loker_id,
            'user_id' => $user->id,
            'subject' => $request->subject,
            'tempat_interview' => $request->tempat_interview,
            'tanggal_interview' => $request->tanggal_interview,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        $loker = LowonganPekerjaan::find($request->loker_id);
        $perusahaan = Perusahaan::find($loker->perusahaan_id);

        $details = [
            'name' => $lamar->lulusan->user->name,
            'perusahaan' => $perusahaan->nama_perusahaan,
            'date' => $request->tanggal_interview,
            'location' => $request->tempat_interview,
            'catatan' => $request->catatan,
            'subject' => $request->subject,
            'nama_loker' => $loker->nama_loker,
        ];

        if (!empty($request->email)) {
            Mail::to($request->email)->send(new SendRecuit($details));
        } else {
            \Log::warning('Attempted to send email without a recipient address.');
        }
       
        // dd($lamar);

        return redirect()->route('search.recruit', ['user'=>$user->user_id])->with('success', 'Recuit berhasil ditambahkan.');
    }

}
