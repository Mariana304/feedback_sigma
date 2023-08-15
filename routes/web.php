<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

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
    return to_route('login');
});

Route::get('/dashboard', [FeedbackController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/Consulta', [FeedbackController::class, 'show'])->name('feedback.show');

Route::get('/gracias', function(){
return view('gracias');
})->name('feedback.gracias');

Route::post('/feedback',[FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback/{token}', [FeedbackController::class, 'index'])->name('feedback.index');

Route::get('/{token}', function ($token) {
   
         $token = Crypt::encryptString($token);
    return to_route('feedback.index', [
        'token' =>  $token]);
 
});
