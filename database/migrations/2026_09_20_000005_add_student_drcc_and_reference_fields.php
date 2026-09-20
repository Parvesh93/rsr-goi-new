<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $fields = [
            'refrence_person_contact',
            'domicile',
            'caste_certificate',
            'bonafide_certificate',
            'drcc_receiving',
            'tpva_form',
            'drcc_selection_letter',
        ];

        foreach ($fields as $field) {
            if (!Schema::hasColumn('students', $field)) {
                Schema::table('students', function (Blueprint $table) use ($field) {
                    $table->string($field)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        $fields = [
            'refrence_person_contact',
            'domicile',
            'caste_certificate',
            'bonafide_certificate',
            'drcc_receiving',
            'tpva_form',
            'drcc_selection_letter',
        ];

        foreach ($fields as $field) {
            if (Schema::hasColumn('students', $field)) {
                Schema::table('students', function (Blueprint $table) use ($field) {
                    $table->dropColumn($field);
                });
            }
        }
    }
};
