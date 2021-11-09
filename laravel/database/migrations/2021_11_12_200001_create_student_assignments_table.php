<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_assignments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('started_date');
            $table->dateTime('uploaded_date')->nullable();
            $table->text('file_path')->nullable();
            $table->tinyInteger('grade')->nullable();

            $table->foreignId('student_id')
                ->references('id')->on('users');
            
            $table->foreignId('assignment_id')
                ->references('id')->on('assignments');

            $table->timestamps(0);
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_assignments');
    }
}
