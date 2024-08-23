<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\LocalController;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


Route::middleware('auth')->group(function (){
    Route::resource('calls',CallsController::class);


});

Route::get('dalyDate',[DateController::class, 'index'])->middleware('auth');
Route::get('calls/ground{ground}',[CallsController::class, 'show'])->middleware('auth');
Route::get('noAnswoer',[DateController::class, 'noAnswoer'])->middleware('auth');
Route::get('arrearsNoAnsower',[DateController::class, 'noAnswoerWithMoreThanDay'])->middleware('auth');
Route::get('arrears',[DateController::class, 'show'])->middleware('auth');
Route::get('doneCustomer',[DateController::class, 'done'])->middleware('auth');
Route::post('print',[DateController::class, 'print'])->middleware('auth');
Route::get('locale/{lang}',[LocalController::class,'setLocale'])->middleware('auth');
Route::get('other',[DateController::class, 'other'])->middleware('auth');
Route::get('blanks',[DateController::class, 'blanks'])->middleware('auth');

/* Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
});
 */
