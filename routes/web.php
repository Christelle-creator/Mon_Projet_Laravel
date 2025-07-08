<?php

use App\Models\Badge;
use App\Http\Controllers\API\BadgeController;
use Illuminate\Support\Facades\Route;

// Route::get('/form-badge', [BadgeController::class, 'create']);
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/badges/{id}', function ($id) {
//     $badge = Badge::findOrFail($id);
//     return view('badge', compact('badge'));
// });


Route::get('/', function() {
    return view('badge_form');
});

Route::get('/form-badge', [BadgeController::class, 'create'])->name('badges.create');
Route::post('/badges', [BadgeController::class, 'store'])->name('badges.store');
Route::get('/badges/{id}', [BadgeController::class, 'show'])->name('badges.show');