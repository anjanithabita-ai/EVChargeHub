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
        Schema::create('chargers', function (Blueprint $table) {
            $table->bigIncrements('id_charger');

            $table->unsignedBigInteger('id_location');

            $table->string('kode_perangkat', 50)->unique();
            $table->string('tipe_konektor', 30);
            $table->decimal('daya_kw', 6, 2);

            $table->enum('status', [
                'tersedia',
                'digunakan',
                'offline',
                'rusak'
            ])->default('tersedia');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

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
        Schema::dropIfExists('chargers');
    }
};
