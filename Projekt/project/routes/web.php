<?php

use App\Models\Donation;
use App\Models\Fundraiser;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|s
*/

Route::get('/', function () {
    return view('Toss_a_coin')
        ->withFundraisers(Fundraiser::orderBy('stop_date')->get()->take(3))
        ->withDonations(Donation::orderBy('created_at')->get()->take(3))
        ->withUsers(User::all()->take(3));
})->name('home');

Route::get('/dashboard', function () {
    $fundraisers = Fundraiser::all();
    $donations = Donation::all();
    return view('dashboard')->withFundraisers($fundraisers)->withDonations($donations);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('fundraisers', \App\Http\Controllers\FundraiserController::class);
Route::resource('fundraisers.donations', \App\Http\Controllers\FundraiserDonationController::class);
Route::resource('users', \App\Http\Controllers\Auth\RegisteredUserController::class);
