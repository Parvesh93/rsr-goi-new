<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('student_enquiries')) {
            Schema::create('student_enquiries', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->nullable();
                $table->string('contact', 50)->nullable();
                $table->unsignedBigInteger('course')->nullable();
                $table->string('state')->nullable();
                $table->string('here_me')->nullable();
                $table->string('refrence_persion')->nullable();
                $table->text('address')->nullable();
                $table->date('enquiry_date')->nullable()->index();
                $table->tinyInteger('status')->default(1)->index();
                $table->timestamps();

                $table->index('course');
                $table->index('refrence_persion');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('student_enquiries');
    }
};
