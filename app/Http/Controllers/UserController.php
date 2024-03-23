<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user.index')->only('index');
        $this->middleware('permission:user.create')->only('create', 'store');
        $this->middleware('permission:user.edit')->only('edit', 'update');
        $this->middleware('permission:user.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //index -> menampilkan tabel data

        Category::create([
            "name" => "Masuk User Page",
        ]);

        // mengambil data
        $users = User::with('roles') // Eager load the 'roles' relationship
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->input('roles'), function ($query, $roles) {
                // The $roles parameter is an array of selected roles
                // Filter users based on the selected roles
                return $query->whereHas('roles', function (Builder $query) use ($roles) {
                    $query->whereIn('name', $roles);
                });
            })
            ->select('id', 'name', 'email', DB::raw("DATE_FORMAT(created_at, '%d %M %Y') as created_at"))
            ->select('id', 'name', 'email', DB::raw("DATE_FORMAT(users.email_verified_at, '%d %M %Y') as email_verified_at"))

            ->paginate(10);

        // Get all roles for the filter dropdown
        $roles = Role::all();


        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // halaman tambah user
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'email_verified_at' => now(),
        ]);

        // Assign roles based on the selected user_type
        $roleName = ($validatedData['user_type'] === 'perusahaan') ? 'Perusahaan' : 'Pencari Kerja';
        $role = Role::where('name', $roleName)->first();
        $user->assignRole($role);

        return redirect(route('user.index'))->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //nampilkan detail satu user
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //mengupdate data user ke database
        $validate = $request->validated();

        $user->update($validate);
        return redirect()->route('user.index')->with('success', 'User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')
                ->with('success', 'Hapus Data User Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('user.index')
                    ->with('error', 'Tidak Dapat Menghapus Data User Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('user.index')
                    ->with('success', 'Hapus Data User Sukses');
            }
        }
    }

    public function verifyEmail($id, $hash)
    {
        $user = User::findOrFail($id);

        if (sha1($user->email) !== $hash) {
            abort(404);
        }

        if (is_null($user->email_verified_at)) {
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('user.index')->with('success', 'Email verified successfully');
        } else {
            $user->email_verified_at = null;
            $user->save();

            return redirect()->route('user.index')->with('success', 'Email verification deleted successfully');
        }
    }
}
