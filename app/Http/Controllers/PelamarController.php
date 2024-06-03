<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PelamarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:lulusan.index')->only('index');
        $this->middleware('permission:lulusan.create')->only('create', 'store');
        $this->middleware('permission:lulusan.edit')->only('edit', 'update');
        $this->middleware('permission:lulusan.destroy')->only('destroy');
        $this->middleware('permission:lulusan.import')->only('import');
        $this->middleware('permission:lulusan.export')->only('export');
    }
    public function index(Request $request)
    {
        // Mengambil role "Lulusan"
        $roleLulusan = Role::where('name', 'Lulusan')->first();

        // Mengambil data pengguna dengan role "Lulusan" dan memiliki profil terkait
        $query = User::with(['lulusan']) // Eager-load the "profile" relation
            ->whereHas('roles', function ($query) use ($roleLulusan) {
                $query->where('id', $roleLulusan->id);
            });

        // Lakukan pencarian berdasarkan nama pengguna jika parameter "name" ada
        if ($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', 'like', "%$name%");
        }

        // Paginasi hasil query
        $lulusan = $query->paginate(10);

        return view('lulusan.index', compact('lulusan'));
    }

    public function edit(User $lulusan)
    {
        return view('lulusan.edit', compact('lulusan'));
    }

    public function update(Request $request, User $lulusan)
    {
        $this->validate($request, [
            // Add validation rules for profile data if needed
        ]);

        // Update the user profile data
        $lulusan->profile->update([
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_hp' => $request->input('no_hp'),
            // Add other profile fields
        ]);

        return redirect()->route('lulusan.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy(User $lulusan)
    {
        try {
            // Delete the user and related profile data
            $lulusan->profile->delete();
            $lulusan->delete();

            return redirect()->route('lulusan.index')->with('success', 'Profile deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle delete error here

            return redirect()->route('lulusan.index')->with('error', 'Failed to delete profile.');
        }
    }

    public function show(User $lulusan)
    {
        $lulusans = User::with(['lulusan', 'pendidikan', 'pengalaman', 'pelatihan', 'postingan', 'portofolio', 'keahlians'])
            ->where('users.id', $lulusan->id)
            ->first();
            // dd($lulusans);
        return view('lulusan.detail', compact('lulusan'));
    }
}
