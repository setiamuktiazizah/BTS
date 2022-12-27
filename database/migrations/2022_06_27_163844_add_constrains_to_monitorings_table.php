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
        Schema::table('monitorings', function (Blueprint $table) {
            $table->foreignId('kondisi_bts_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_surveyor_id')->constrained('users');
            $table->foreignId('created_by');
            $table->foreignId('edited_by');
            $table->foreignId('bts_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitorings', function (Blueprint $table) {
            //
        });
    }
};
