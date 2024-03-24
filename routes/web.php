<?php

use App\Http\Controllers\AlljobsController;
use App\Http\Controllers\AllPostinganController;
use App\Http\Controllers\DetailPerusahaan;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\KeahlianController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\KategoriPekerjaanController;
use App\Http\Controllers\LokerPerusahaanController;
use App\Http\Controllers\LowonganPekerjaanController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\PostinganAdminController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\LamarPerusahaanController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\ExportPermissionController;
use App\Http\Controllers\RoleAndPermission\ExportRoleController;
use App\Http\Controllers\RoleAndPermission\ImportPermissionController;
use App\Http\Controllers\RoleAndPermission\ImportRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\LulusanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PerusahaanListController;
use App\Http\Controllers\ProfileKeahlianController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Kota;
use App\Models\LowonganPekerjaan;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\MelamarController;
use App\Http\Controllers\StatusLamarController;
use App\Http\Controllers\RekomendasiLokerController;
use App\Http\Controllers\RekomendasiLulusanController;
use App\Http\Controllers\RekomendasiRangkingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });
// Route::get('/', function () {
//     return view('welcome');
//     // return view('welcome');
//     // return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/all-jobs', [AlljobsController::class, 'index'])->name('all-jobs.index');
Route::get('/all-jobs/{loker}', [AlljobsController::class, 'show'])->name('all-jobs.show');
// Route::get('/all-jobs/{loker}', [AlljobsController::class, 'detail_rekomendasi'])->name('all-jobs.detail_rekomendasi');
Route::get('/all-postingan', [AllPostinganController::class, 'index'])->name('all-postingan.index');
Route::get('/detail-perusahaan/{detail}', [DetailPerusahaan::class, 'show'])->name('detail-perusahaan.show');

Route::get('/login', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->hasRole('super-admin')) {
            return redirect('/dashboard');
        } elseif ($user->hasRole('lulusan') || $user->hasRole('perusahaan')) {
            return redirect('/welcome');
        }
    } else {
        return view('auth/login');
    }
})->name('login');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('home', ['users' => User::get(),]);
    });
    //user list

    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::match(['get', 'post'], '/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])->name('user.verify-email');
        Route::delete('/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])->name('user.delete-verify-email');
        Route::post('import', [UserController::class, 'import'])->name('user.import');
        Route::get('export', [UserController::class, 'export'])->name('user.export');
        Route::get('demo', DemoController::class)->name('user.demo');
        Route::post('user/update-roles/{user}', [UserController::class, 'updateRoles'])->name('user.update-roles'); // <- Add this line
        Route::get('/user/show/{user}', [UserController::class, 'view'])->name('user.view');

        Route::resource('lulusan', PelamarController::class);
        Route::get('/lulusan', 'App\Http\Controllers\PelamarController@index')->name('lulusan.index');

        Route::resource('perusahaan', PerusahaanListController::class);
        Route::get('/perusahaan', 'App\Http\Controllers\PerusahaanListController@index')->name('perusahaan.index');

        Route::resource('postinganadmin', PostinganAdminController::class);
    });

    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::resource('menu-item', MenuItemController::class);
    });
    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::get('role/export', ExportRoleController::class)->name('role.export');
        Route::post('role/import', ImportRoleController::class)->name('role.import');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::get('permission/export', ExportPermissionController::class)->name('permission.export');
        Route::post('permission/import', ImportPermissionController::class)->name('permission.import');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
    });
    Route::prefix('menu-pekerjaan')->group(function () {
        Route::resource('keahlian', KeahlianController::class);
        Route::resource('kategori', KategoriPekerjaanController::class);
        Route::resource('loker', LowonganPekerjaanController::class);
        Route::resource('pelamarkerja', LamarController::class);
    });

    Route::prefix('rekomendasi-management')->group(function () {
        Route::get('/perhitungan/rekomendasi-loker', [RekomendasiLokerController::class, 'index']);
        Route::get('/perhitungan/rekomendasi-lulusan', [RekomendasiLulusanController::class, 'index']);
        Route::get('/perhitungan/perangkingan', [RekomendasiRangkingController::class, 'index']);
    });

    Route::prefix('location-management')->group(function () {
        // kota
        Route::resource('kota', KotaController::class)->parameters([
            'kota' => 'kotum',]);
        Route::post('kota/import', [KotaController::class, 'import'])->name('kota.import');
    });

    //profile lulusan
    Route::GET('/profilelulusan', [LulusanController::class, 'profile']);
    Route::GET('/profilelulusan', [LulusanController::class, 'index']);
    Route::get('/profilelulusan', [LulusanController::class, 'index'])->name('profile.index');
    Route::delete('/profilelulusan/{profile}', [LulusanController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile-admin', function () {
        return view('profile.super-admin');
    });
    Route::GET('/profile-edit', [LulusanController::class, 'profile'])->name('profile.edit');
    Route::get('/getKelurahans', [LulusanController::class, 'getKelurahans'])->name('getKelurahans');
    Route::PUT('/update-profile-information', [LulusanController::class, 'update'])->name('profile.user.update');
    Route::PUT('/update-perusahaan-information', [PerusahaanController::class, 'update'])->name('profile.perusahaan.update');

    // //profile perusahaan
    // Route::GET('/profileperusahaan', [PerusahaanController::class, 'profile']);
    // Route::GET('/profileperusahaan', [PerusahaanController::class, 'index']);
    // Route::get('/profileperusahaan', [PerusahaanController::class, 'index'])->name('profile.index');
    // Route::delete('/profileperusahaan/{profile}', [PerusahaanController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/profile-admin', function () {
    //     return view('profile.super-admin');
    // });
    // Route::GET('/profile-edit', [PerusahaanController::class, 'profile'])->name('profile.edit');
    // Route::get('/getKelurahans', [PerusahaanController::class, 'getKelurahans'])->name('getKelurahans');
    // Route::PUT('/update-profile-information', [PerusahaanController::class, 'update'])->name('profile.user.update');
    // Route::PUT('/update-perusahaan-information', [PerusahaanController::class, 'update'])->name('profile.perusahaan.update');

});

Route::group(['middleware' => ['auth', 'verified', 'role:lulusan|perusahaan']], function () {
    Route::get('/welcome', [WelcomeController::class, 'index']);

    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/toggle', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle');
    Route::post('/bookmark/remove', [BookmarkController::class, 'removeBookmark'])->name('bookmark.remove'); // Add this line
    Route::post('/bookmark/add', [BookmarkController::class, 'addBookmark'])->name('bookmark.add'); // Add this line
    Route::post('/melamar', [MelamarController::class, 'store'])->name('melamar.store');

    Route::resource('lamarperusahaan', LamarPerusahaanController::class);
    //loker-perusahaan
    Route::resource('loker-perusahaan', LokerPerusahaanController::class);
    Route::get('/status-lamaran', [StatusLamarController::class, 'index'])->name('melamar.status');
});
