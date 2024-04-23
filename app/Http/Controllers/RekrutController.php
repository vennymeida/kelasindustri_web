<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Models\Lulusan;
use App\Http\Requests\StorelamarRequest;
use App\Http\Requests\UpdatelamarRequest;
use App\Mail\SendEmailPelamar;
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
        // $request->validate([
        //     'loker_id' => 'required|exists:lokers,id',
        //     'user_id' => 'required|exists:lulusans,id',
        //     'subject' => 'nullable|string|max:255',
        //     'tempat_interview' => 'nullable|string|max:255',
        //     'tanggal_interview' => 'nullable|date',
        //     'catatan' => 'nullable|string',
        //     'status' => 'nullable|in:diterima,ditolak,pending',
        // ]);

        $lamar = Lamar::create([
            'loker_id' => $request->loker_id,
            'user_id' => $user->id,
            'subject' => $request->subject,
            'tempat_interview' => $request->tempat_interview,
            'tanggal_interview' => $request->tanggal_interview,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);
        // dd($lamar);
        return redirect()->route('search.recruit', ['user'=>$user->user_id]);
    }

}
