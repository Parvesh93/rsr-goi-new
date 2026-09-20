<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $fields = [
            'present_pin',
            'permanent_pin',
            'branch_code',
            'passbook',
            'high_school_marksheet',
            'intermediate_marksheet',
            'graduation_registration_certificate',
            'graduation_degree_certificate',
            'first_year_marksheet',
            'second_year_marksheet',
            'experience_letter',
            'pg_registration_certificate',
            'pg_degree_certificate',
            'aadhar_card',
            'pan_card',
        ];

        foreach ($fields as $field) {
            if (!Schema::hasColumn('users', $field)) {
                Schema::table('users', function (Blueprint $table) use ($field) {
                    $table->string($field)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        $fields = [
            'present_pin',
            'permanent_pin',
            'branch_code',
            'passbook',
            'high_school_marksheet',
            'intermediate_marksheet',
            'graduation_registration_certificate',
            'graduation_degree_certificate',
            'first_year_marksheet',
            'second_year_marksheet',
            'experience_letter',
            'pg_registration_certificate',
            'pg_degree_certificate',
            'aadhar_card',
            'pan_card',
        ];

        foreach ($fields as $field) {
            if (Schema::hasColumn('users', $field)) {
                Schema::table('users', function (Blueprint $table) use ($field) {
                    $table->dropColumn($field);
                });
            }
        }
    }
};
