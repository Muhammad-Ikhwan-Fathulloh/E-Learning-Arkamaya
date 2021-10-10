<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inputprogress extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mentor',
        'id_student',
        'id_material',
        'score_material',
        'description_progress',
    ];
}
