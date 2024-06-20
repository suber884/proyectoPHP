<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/libro', function () {
//     return view('libro.index');
// });
// Route::get('/libro/create',[LibroController::class,'create']);

Route::resource('libro',LibroController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [LibroController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[LibroController::class,'index'])->name('home');
});
