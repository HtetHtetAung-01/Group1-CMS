<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'name', 'description', 'duration', 'file_path', 'course_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}