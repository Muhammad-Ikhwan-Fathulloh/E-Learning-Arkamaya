<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mentor',
        'id_student',
        'date_presensi',
        'description_presensi',
        'status_presensi',
    ];
}
