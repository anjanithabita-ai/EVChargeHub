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
        Schema::create('tariffs', function (Blueprint $table) {
            $table->bigIncrements('id_tariff');

            $table->unsignedBigInteger('id_location');

            $table->decimal('harga_per_kwh', 12, 2);
            $table->decimal('biaya_minimum', 12, 2)->default(0);
            $table->decimal('biaya_parkir', 12, 2)->default(0);

            $table->dateTime('berlaku_mulai');
            $table->dateTime('berlaku_selesai')->nullable();

            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->foreign('id_location')
                ->references('id_location')
                ->on('locations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariffs');
    }
};
