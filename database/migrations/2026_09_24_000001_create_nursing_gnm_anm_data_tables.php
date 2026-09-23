<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['nursing_data', 'gnm_data', 'anm_data'];

        foreach ($tables as $tableName) {
            if (!Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('student_id')->index();
                    $table->unsignedTinyInteger('year')->nullable();
                    $table->string('marksheet')->nullable();
                    $table->string('admit_card')->nullable();
                    $table->timestamps();
                });
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('anm_data');
        Schema::dropIfExists('gnm_data');
        Schema::dropIfExists('nursing_data');
    }
};
