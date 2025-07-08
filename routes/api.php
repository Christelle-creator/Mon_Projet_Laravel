<?php

use App\Http\Controllers\BadgeController;

Route::get('/badges', [BadgeController::class, 'index']);
Route::post('/badges', [BadgeController::class, 'store']);
//Route::get('/badges', function() {
//    return 'OK';
//}); 