<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\ProfileUser;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AllPostinganController extends Controller
{
    public function index(Request $request)
    {
        $allResults = DB::table('postingans as lp')
            ->join('users as u', 'lp.user_id', '=', 'u.id')
            ->leftJoin('profile_users as pu', 'u.id', '=', 'pu.user_id')
            ->select('lp.id', 'lp.user_id', 'lp.konteks', 'lp.media', 'pu.ringkasan', 'pu.foto', 'u.name', 'u.email', 'lp.created_at') // Sertakan created_at
            ->orderBy('lp.created_at', 'desc')
            ->paginate(5);

        $user = null;
        $profile = null;

        if (auth()->check()) {
            $user = auth()->user();
            $profile = ProfileUser::where('user_id', $user->id)->first();
        }

        foreach ($allResults as $result) {
            $result->created_ago = $this->calculateTimeAgo($result->created_at);
        }

        return view('all-postingan', [
            'allResults' => $allResults,
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    private function calculateTimeAgo($timestamp)
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
}
