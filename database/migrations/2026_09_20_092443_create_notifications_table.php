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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // User yang menerima notifikasi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Judul notifikasi
            $table->string('title');

            // Isi notifikasi
            $table->text('message');

            // Jenis notifikasi
            $table->string('type')->nullable();

            // Menandai apakah sudah dibaca
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
