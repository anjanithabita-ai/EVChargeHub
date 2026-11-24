<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('charger_reports', function (Blueprint $table) {
            $table->bigIncrements('id_report');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_charger');
            $table->string('kategori', 60);
            $table->text('deskripsi');
            $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])
                ->default('baru');
            $table->text('catatan_operator')->nullable();
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_charger')
                ->references('id_charger')->on('chargers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('charger_reports');
    }
};
