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
        Schema::table('kuesioner_monitorings', function (Blueprint $table) {
            $table->foreignId('monitoring_id')->constrained()->onDelete('cascade');
            $table->foreignId('kuesioner_id')->constrained();
            $table->foreignId('jawaban_kuesioner_id')->constrained();
            $table->foreignId('created_by');
            $table->foreignId('edited_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kuesioner_monitorings', function (Blueprint $table) {
            //
        });
    }
};
