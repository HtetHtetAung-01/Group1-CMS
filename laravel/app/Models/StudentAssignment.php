<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{

    protected $table = 'student_assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'assignment_id',
        'student_id',
        'started_date',
        'uploaded_date',
        'file_path',
        'grade'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}