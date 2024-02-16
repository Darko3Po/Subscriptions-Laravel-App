<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Subscriptions\SubscriptionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Subscriptions'], function (){
    Route::get('plans',[PlanController::class,'index'])->name('subscriptions.plans');
    Route::get('subscriptions',[SubscriptionsController::class,'index'])->name('subscriptions');
    Route::post('subscriptions',[SubscriptionsController::class,'store']);
});

Route::group(['namespace' => 'Account','prefix' => 'account'], function (){
    Route::get('/',[AccountController::class,'index'])->name('account');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
