<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignments extends Model
{
    use HasFactory;

    protected $fillable = [
        'started_date',
        'uploaded_date',
        'file_path',
        'grade',
        'student_id',
        'assignment_id',
    ];
}