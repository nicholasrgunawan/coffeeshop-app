<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['visit_date', 'visitors_count'];

    public $timestamps = true; // Assuming you want to use created_at and updated_at
}


