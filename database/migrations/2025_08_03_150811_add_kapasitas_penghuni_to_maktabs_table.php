<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('maktabs', function (Blueprint $table) {
            $table->integer('kapasitas_penghuni')->after('nomor_telepon');
            $table->integer('sisa_kapasitas')->default(0)->after('kapasitas_penghuni');
        });
    }

    public function down()
    {
        Schema::table('maktabs', function (Blueprint $table) {
            $table->dropColumn('kapasitas_penghuni');
        });
    }
};
