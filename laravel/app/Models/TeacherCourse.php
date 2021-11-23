<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    use HasFactory;
    protected $table = 'teacher_courses';

   /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['teacher_id', 'course_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
