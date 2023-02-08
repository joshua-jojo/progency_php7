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
        Schema::create('perumahans', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->integer('developer_id');
            $table->integer('developer_perumahan_id');
            $table->string('kode')->nullable();
            $table->string('nama');
            $table->string('tipe');
            $table->string('blok');
            $table->text('alamat');
            $table->string('jenis');
            $table->string('sertifikat');
            $table->bigInteger('harga');
            $table->text('deskripsi')->nullable();
            $table->enum('kondisi', ['baru', 'bekas']);
            $table->enum('status', ['tersedia', 'dp', 'sold']);
            $table->string('cover');
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
        Schema::dropIfExists('perumahans');
    }
};
