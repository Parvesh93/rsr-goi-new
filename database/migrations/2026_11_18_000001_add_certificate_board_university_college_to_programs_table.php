<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('certificate_board_university_college', 255)->nullable()->after('shortcode');
        });

        // Defaults confirmed from the approved certificate samples.
        DB::table('programs')
            ->where(function ($query) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%nursing%'])
                      ->orWhereRaw('LOWER(title) LIKE ?', ['%auxiliary%midwifery%'])
                      ->orWhereRaw('LOWER(title) LIKE ?', ['%general%nursing%midwifery%']);
            })
            ->update([
                'certificate_board_university_college' => 'BIHAR NURSES REGISTRATION COUNCIL, PATNA',
            ]);

        DB::table('programs')
            ->where(function ($query) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%bachelor of arts%'])
                      ->orWhereRaw('LOWER(title) LIKE ?', ['%bachelor of science%'])
                      ->orWhereRaw('LOWER(title) LIKE ?', ['%bachelor of education%']);
            })
            ->whereRaw('LOWER(title) NOT LIKE ?', ['%nursing%'])
            ->update([
                'certificate_board_university_college' => 'BABASAHEB BHIMRAO AMBEDKAR BIHAR UNIVERSITY, MUZAFFARPUR',
            ]);
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('certificate_board_university_college');
        });
    }
};
