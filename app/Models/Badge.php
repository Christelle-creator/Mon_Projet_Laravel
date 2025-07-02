<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prénom',
        'email',
        'téléphone',
        'qr_code',
        'fonction',
        'organisation',
        'photo',
        'date_badge',
    ];
}
