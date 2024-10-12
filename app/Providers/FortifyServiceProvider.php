<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        if (request()->is('admin/*')) {
            // الشرط يتحقق مما إذا كان المسار الحالي في التطبيق يبدأ بـ 'admin/'.
            // علامة * تعني أي شيء بعد 'admin/'، مثل 'admin/dashboard' أو 'admin/settings'.

            config()->set('fortify.guard', 'admin');
            // يقوم بتعيين إعداد الحماية (guard) في Fortify إلى 'admin'.
            // هذا يعني أن Fortify سيستخدم الحماية المخصصة 'admin' بدلاً من الافتراضية (مثل الحماية للمستخدمين العاديين).

            config()->set('fortify.home', '/admin/dashboard');
            // يقوم بتعيين المسار الافتراضي لصفحة المنزل (home) بعد تسجيل الدخول إلى '/admin/home'
            // للمستخدمين الإداريين بدلاً من الصفحة الافتراضية (مثل '/dashboard').

            config()->set('fortify.prefix', '/admin');
            config()->set('fortify.passwords', 'admins');


        }

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/')->intended('/');
            }
        });

        $this->app->instance(LoginResponse::class, new class extends LoginResponse {
            public function toResponse($request)
            {
                if ($request->user('admin')) {
                    return redirect()->intended('/admin/dashboard');
                }
                return redirect()->intended('/');
            }
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


// السطر ده بيغنيني عن كل الي تحت لانه بيعرفهم من نفسه عن طريق التسميه بتاعتهم زي الي انا عاملها فملف ال view
// وكلهم موجودين جوا ملف ال auth
        // Fortify::viewPrefix('auth.');
        if (Config::get('fortify.guard')=='admin') {
            Fortify::viewPrefix('auth.admin.');

        }else {
            Fortify::viewPrefix('auth.');
            # code...
        }

        // Fortify::registerView(function () {
        //     return view('auth.register');
        // });

        // Fortify::loginView('auth.login');

        // Fortify::requestPasswordResetLinkView(function () {
        //     return view('auth.forgot-password');
        // });

        // Fortify::resetPasswordView(function ($request) {
        //     return view('auth.reset-password', ['request' => $request]);
        // });

        // Fortify::verifyEmailView(function () {
        //     return view('auth.verify-email');
        // });

        // Fortify::confirmPasswordView(function () {
        //     return view('auth.password-confirm');
        // });

        // Fortify::twoFactorChallengeView(function () {
        //     return view('auth.two-factor-challenge');
        // });
    }
}
