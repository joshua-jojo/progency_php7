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
        Schema::create('perumahan_details', function (Blueprint $table) {
            $table->id();
            $table->integer('perumahan_id');
            $table->string('cluster')->nullable();
            $table->string('kamar_tidur')->nullable();
            $table->string('lantai')->nullable();
            $table->string('kamar_mandi')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->string('garasi')->nullable();
            $table->string('daya_listrik')->nullable();
            $table->integer('tahun_dibangun')->nullable();
            $table->text('fasilitas')->nullable();
            $table->enum('kondisi_parabotan', ['tidak tersedia', 'tersedia']);
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perumahan_details');
    }
};
