<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->string('cc_college')->nullable();
            $table->string('cc_college_add')->nullable();
            $table->string('cc_college_run')->nullable();
            $table->string('cc_college_reco')->nullable();
            $table->string('cc_college_app')->nullable();
            $table->string('cc_college_var')->nullable();
            $table->string('cc_college_img')->nullable();
            $table->string('cc_logo_img')->nullable();
            $table->string('cc_college_email')->nullable();
            $table->string('cc_college_phone')->nullable();
        });

        // Seed the new Course Completion settings once from the existing CLC
        // settings so current certificates do not become blank after deployment.
        DB::table('batches')->orderBy('id')->chunkById(100, function ($batches) {
            foreach ($batches as $batch) {
                DB::table('batches')->where('id', $batch->id)->update([
                    'cc_college' => $batch->clc_college ?? null,
                    'cc_college_add' => $batch->clc_college_add ?? null,
                    'cc_college_run' => $batch->clc_college_run ?? null,
                    'cc_college_reco' => $batch->clc_college_reco ?? null,
                    'cc_college_app' => $batch->clc_college_app ?? null,
                    'cc_college_var' => $batch->clc_college_var ?? null,
                    'cc_college_img' => $batch->clc_college_img ?? null,
                    'cc_logo_img' => $batch->clc_logo_img ?? null,
                    'cc_college_email' => $batch->college_email ?? null,
                    'cc_college_phone' => $batch->college_phone ?? null,
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropColumn([
                'cc_college',
                'cc_college_add',
                'cc_college_run',
                'cc_college_reco',
                'cc_college_app',
                'cc_college_var',
                'cc_college_img',
                'cc_logo_img',
                'cc_college_email',
                'cc_college_phone',
            ]);
        });
    }
};
