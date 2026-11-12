<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('attendance_code', 8)->nullable()->unique()->after('public_token');
        });

        DB::table('pendaftarans')->select('id')->orderBy('id')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                do {
                    $code = Str::upper(Str::random(8));
                } while (DB::table('pendaftarans')->where('attendance_code', $code)->exists());

                DB::table('pendaftarans')->where('id', $row->id)->update(['attendance_code' => $code]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropUnique(['attendance_code']);
            $table->dropColumn('attendance_code');
        });
    }
};
