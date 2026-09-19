<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('program_conditions')) {
            Schema::create('program_conditions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ba_id')->nullable();
                $table->unsignedBigInteger('b_com_id')->nullable();
                $table->unsignedBigInteger('bsc_id')->nullable();
                $table->unsignedBigInteger('bsc_nursing_id')->nullable();
                $table->unsignedBigInteger('gnm_id')->nullable();
                $table->unsignedBigInteger('anm_id')->nullable();
                $table->tinyInteger('status')->default(1)->index();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('program_conditions');
    }
};
