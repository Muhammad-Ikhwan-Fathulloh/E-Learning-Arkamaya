<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;

    protected $fillable = [
    	'created_by',
        'updated_by',
        'icon_nav',
        'name_nav',
        'link_nav',
    ];
}