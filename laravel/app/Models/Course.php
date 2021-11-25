<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'category',
        'description',
        'required_courses'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}