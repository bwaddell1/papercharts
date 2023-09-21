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

// Authentication routes
Auth::routes();

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Wave routes
Wave::routes();


Route::get('/team-invitations/{invitation}', [InvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');

Route::post('/team-invitations/{invitation}/register', [InvitationController::class, 'register'])->name('team-invitations.register');

