<?php

use App\Models\Badge;
use App\Http\Controllers\BadgeController;
use Illuminate\Support\Facades\Route;

Route::get('/front', function () {
     return 'Tout fonctionne.'
});
Route::get('/badges/create', [BadgeController::class, 'create'])->name('create');
Route::get('/', function () {
     return view('welcome');
});
Route::get('/badges/{id}', function ($id) {
     $badge = Badge::findOrFail($id);
     return view('badge', compact('badge'));
});
Route::post('/badges', [BadgeController::class, 'store'])->name('store');

Route::get('/{id}', [BadgeController::class, 'show'])->name('show');

Route::get('/{id}/edit', [BadgeController::class, 'edit'])->name('edit');

Route::put('/{id}', [BadgeController::class, 'update'])->name('update');

Route::delete('/{id}', [BadgeController::class, 'destroy'])->name('destroy');

