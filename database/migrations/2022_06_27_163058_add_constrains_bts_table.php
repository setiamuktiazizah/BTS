<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bts', function (Blueprint $table) {
            $table->foreignId('pemilik_id')->constrained('pemiliks');
            $table->foreignId('wilayah_id')->constrained();
            $table->foreignId('created_by');
            $table->foreignId('edited_by');
            $table->foreignId('jenis_bts_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bts', function (Blueprint $table) {
            //
        });
    }
};
