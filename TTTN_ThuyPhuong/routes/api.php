<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('brand')->group(function(){
    Route::get('status/{brand}',[App\Http\Controllers\Api\BrandController::class,'status'])->name('brand.status');
    Route::get('edit/{brand}',[App\Http\Controllers\Api\BrandController::class,'edit'])->name('brand.edit');
    Route::get('show/{brand}',[App\Http\Controllers\Api\BrandController::class,'show'])->name('brand.show');
    Route::get('trash',[App\Http\Controllers\Api\BrandController::class,'trash'])->name('brand.trash');
    Route::get('delete/{brand}',[App\Http\Controllers\Api\BrandController::class,'delete'])->name('brand.delete');
    Route::get('restore/{brand}',[App\Http\Controllers\Api\BrandController::class,'restore'])->name('brand.restore');
});
Route::resource('brand',App\Http\Controllers\Api\BrandController::class)->except(['create']);
