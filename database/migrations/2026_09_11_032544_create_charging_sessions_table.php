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
        Schema::create('charging_sessions', function (Blueprint $table) {
            $table->bigIncrements('id_session');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_vehicle');
            $table->unsignedBigInteger('id_charger');
            $table->unsignedBigInteger('id_tariff');

            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai')->nullable();

            $table->decimal('energi_kwh', 10, 2)->default(0);
            $table->integer('durasi_menit')->default(0);
            $table->decimal('total_biaya', 12, 2)->default(0);

            $table->enum('status', [
                'berlangsung',
                'selesai',
                'dibatalkan',
                'gagal'
            ])->default('berlangsung');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users');

            $table->foreign('id_vehicle')
                ->references('id_vehicle')
                ->on('vehicles');

            $table->foreign('id_charger')
                ->references('id_charger')
                ->on('chargers');

            $table->foreign('id_tariff')
                ->references('id_tariff')
                ->on('tariffs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_sessions');
    }
};
