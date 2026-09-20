<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('applications', 'ref_persion')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->string('ref_persion')->nullable()->index();
            });
        }

        if (!Schema::hasColumn('applications', 'refrence_person_contact')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->string('refrence_person_contact', 50)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('applications', 'refrence_person_contact')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->dropColumn('refrence_person_contact');
            });
        }

        if (Schema::hasColumn('applications', 'ref_persion')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->dropColumn('ref_persion');
            });
        }
    }
};
