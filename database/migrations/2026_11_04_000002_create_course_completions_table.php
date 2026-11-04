<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('course_completions')) {
            Schema::create('course_completions', function (Blueprint $table) {
                $table->id();
                $table->string('type', 30)->index();
                $table->string('student_id')->nullable()->index();
                $table->string('registration_no')->nullable()->index();
                $table->unsignedInteger('serial_no')->nullable();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->unsignedBigInteger('program_id')->nullable()->index();
                $table->unsignedBigInteger('session_id')->nullable()->index();
                $table->string('name');
                $table->string('father_name');
                $table->string('mother_name')->nullable();
                $table->date('date');
                $table->date('course_start_date')->nullable();
                $table->date('course_end_date')->nullable();
                $table->date('relieving_date')->nullable();
                $table->string('college_name')->nullable();
                $table->tinyInteger('status')->default(1)->index();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('course_completions');
    }
};
