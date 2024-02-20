<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(
            RegisterResponse::class,
            new class implements RegisterResponse
            {
                public function toResponse($request)
                {
                    $user = Auth::user();
                    $role = $user->roles->first()->name;

                    if ($user->hasRole('perusahaan')) {
                        return $request->wantsJson()
                            ? response()->json(['two_factor' => false])
                            : redirect(config('fortify.home-perusahaan'));
                    }
                    if ($user->hasRole('lulusan')) {
                        return $request->wantsJson()
                            ? response()->json(['two_factor' => false])
                            : redirect(config('fortify.home-lulusan'));
                    }
                }
            }
        );

        $this->app->instance(
            LoginResponse::class,
            new class implements LoginResponse
            {
                public function toResponse($request)
                {
                    if (Auth::user()->hasRole('super-admin')) {
                        return $request->wantsJson()
                            ? response()->json(['two_factor' => false])
                            : redirect()->intended(config('fortify.home'));
                    }
                    if (Auth::user()->hasRole('perusahaan')) {
                        return $request->wantsJson()
                            ? response()->json(['two_factor' => false])
                            : redirect()->intended(config('fortify.home-perusahaan'));
                    }

                    if (Auth::user()->hasRole('lulusan')) {
                        return $request->wantsJson()
                            ? response()->json(['two_factor' => false])
                            : redirect()->intended(config('fortify.home-lulusan'));
                    }
                }
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        //register
        Fortify::registerView(function () {
            return view('auth.register');
        });

        //login
        Fortify::loginView(function () {
            return view('auth.login');
        });

        //forgot
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        //reset
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        //verify account
        Fortify::verifyEmailView(function () {
            return view('auth.verify');
        });
    }
}
