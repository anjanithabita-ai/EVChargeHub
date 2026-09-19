<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id_location');

            $table->string('nama_lokasi', 100);
            $table->text('alamat');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();

            $table->text('fasilitas')->nullable();
            $table->string('foto', 255)->nullable();

            $table->enum('status', [
                'aktif',
                'tutup',
                'maintenance'
            ])->default('aktif');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
