<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionCancleController;
use App\Http\Controllers\SubscriptionResumeController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Subscriptions\SubscriptionsController;
use App\Http\Middleware\Subscribed;
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


    Route::group(['namespace' => 'Subscriptions', 'prefix' => 'subscriptions'], function (){
       Route::get('/',[SubscriptionController::class,'index'])->name('account.subscriptions');
       Route::get('/cancel',[SubscriptionCancleController::class,'index'])->name('account.subscriptions.cancel');
       Route::post('/cancel',[SubscriptionCancleController::class,'store']);

        Route::get('/resume',[SubscriptionResumeController::class,'index'])->name('account.subscriptions.resume');
        Route::post('/resume',[SubscriptionResumeController::class,'store']);
    });

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
