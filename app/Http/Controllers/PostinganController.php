<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Postingan;
use App\Http\Requests\StorePostinganRequest;
use App\Http\Requests\UpdatePostinganRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
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

    public function index(Postingan $postingan)
    {
        $userId = Auth::user()->id;
        $postingan = Postingan::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        foreach ($postingan as $time) {
            $time->timeAgo = $this->getTimeAgo($time->updated_at);
        }

        return view('profile.postingan', compact('postingan'));
    }

    public function create()
    {
        return view('profile.index');
    }

    public function store(StorePostinganRequest $request)
    {
        $userId = Auth::user()->id;

        $postingan = new Postingan($request->validated());
        $postingan->user_id = $userId;

        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $filename = time() . '_' . $media->getClientOriginalName();
            $path = $media->storeAs('media', $filename, 'public');
            $postingan->media = $path;
        }

        $postingan->save();

        return redirect()->route('postingan.index')->with('success', 'success-create');
    }

    public function show(Postingan $postingan)
    {
        //
    }

    public function edit(Postingan $postingan)
    {
        if ($postingan->user_id !== Auth::id()) {
            return redirect()->route('profile.index')->with('error', 'Anda tidak memiliki izin untuk mengedit postingan ini.');
        }
        return response()->json($postingan);
    }


    public function update(Request $request, Postingan $postingan)
    {
        try {
            $userId = Auth::user()->id;

            // Verification if the user attempting to edit the post is the owner of the post
            if ($postingan->user_id !== $userId) {
                return response()->json(['success' => false, 'message' => 'Unauthorized action.']);
            }

            // Validate the input from the form
            $validatedData = $request->validate([
                'konteks' => 'required|string',
                'media' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $postingan->konteks = $validatedData['konteks'];

            // Check if there is a new uploaded file
            if ($request->hasFile('media')) {
                // Delete the old media file if it exists
                if ($postingan->media) {
                    Storage::disk('public')->delete($postingan->media);
                }

                // Upload and save the new media file
                $media = $request->file('media');
                $filename = time() . '_' . $media->getClientOriginalName();
                $path = $media->storeAs('media', $filename, 'public');
                $postingan->media = $path;
            }

            $postingan->save();

            return response()->json(['success' => true, 'message' => 'Postingan berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function destroy(Postingan $postingan)
    {
        // Hapus gambar dari penyimpanan sebelum menghapus postingan
        if ($postingan->media) {
            Storage::disk('public')->delete($postingan->media);
        }

        $postingan->delete();

        return redirect()->route('profile-lulusan.index')->with('success', 'success-delete');
    }
}
