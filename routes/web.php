<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use Wave\Facades\Wave;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginMagicLinkController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Features;
use Laravel\Fortify\RoutePath;

// Authentication routes
Auth::routes();

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('/login/magic',[LoginMagicLinkController::class,'sendMagicLink'])->name('magic.login');
Route::get('/magic-login/{user}', [LoginMagicLinkController::class, 'loginWithMagicLink'])->name('magic.confirm');

// Wave routes
Wave::routes();


Route::get('/team-invitations/{invitation}', [InvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');

Route::post('/team-invitations/{invitation}/register', [InvitationController::class, 'register'])->name('team-invitations.register');


if (Features::enabled(Features::twoFactorAuthentication())) {
    $enableViews = config('fortify.views', true);
    $twoFactorLimiter = config('fortify.limiters.two-factor');

    Route::post(RoutePath::for('two-factor.login.custom', '/two-factor-challenge'), [App\Http\Controllers\Controller::class, 'twoFactorVerify'])
        ->name('two-factor.login');

    $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
        ? [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'password.confirm']
        : [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')];

    Route::post(RoutePath::for('two-factor.enable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'store'])
        ->middleware($twoFactorMiddleware)
        ->name('two-factor.enable');

    // Route::post(RoutePath::for('two-factor.confirm', '/user/confirmed-two-factor-authentication'), [ConfirmedTwoFactorAuthenticationController::class, 'store'])
    //     ->middleware($twoFactorMiddleware)
    //     ->name('two-factor.confirm');

    // Route::delete(RoutePath::for('two-factor.disable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'destroy'])
    //     ->middleware($twoFactorMiddleware)
    //     ->name('two-factor.disable');

    // Route::get(RoutePath::for('two-factor.qr-code', '/user/two-factor-qr-code'), [TwoFactorQrCodeController::class, 'show'])
    //     ->middleware($twoFactorMiddleware)
    //     ->name('two-factor.qr-code');

    // Route::get(RoutePath::for('two-factor.secret-key', '/user/two-factor-secret-key'), [TwoFactorSecretKeyController::class, 'show'])
    //     ->middleware($twoFactorMiddleware)
    //     ->name('two-factor.secret-key');

    // Route::get(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'index'])
    //     ->middleware($twoFactorMiddleware)
    //     ->name('two-factor.recovery-codes');

    // Route::post(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'store'])
    //     ->middleware($twoFactorMiddleware);

}
