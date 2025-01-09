<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIsbnToBigintInKatalogbuku extends Migration
{
    public function up()
    {
        Schema::table('katalogbuku', function (Blueprint $table) {
            // Ubah tipe data ISBN menjadi BIGINT
            $table->bigInteger('ISBN')->unsigned()->change();
        });
    }

    public function down()
    {
        Schema::table('katalogbuku', function (Blueprint $table) {
            // Kembalikan tipe data ISBN ke tipe sebelumnya, misalnya VARCHAR
            $table->string('ISBN', 255)->change();
        });
    }
}
