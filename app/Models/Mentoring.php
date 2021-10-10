<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mentor',
        'id_student',
        'pesan',
        'file',
    ];
}
