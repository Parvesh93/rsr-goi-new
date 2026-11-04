<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('nursing_clcs') && !Schema::hasColumn('nursing_clcs', 'relieving_date')) {
            Schema::table('nursing_clcs', function (Blueprint $table) {
                $table->date('relieving_date')->nullable()->after('date');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('nursing_clcs') && Schema::hasColumn('nursing_clcs', 'relieving_date')) {
            Schema::table('nursing_clcs', function (Blueprint $table) {
                $table->dropColumn('relieving_date');
            });
        }
    }
};
