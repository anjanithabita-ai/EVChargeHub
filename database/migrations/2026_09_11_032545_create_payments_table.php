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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id_payment');

            $table->unsignedBigInteger('id_session')->unique();

            $table->enum('metode', [
                'ewallet',
                'card',
                'qr',
                'saldo'
            ]);

            $table->decimal('jumlah', 12, 2);

            $table->enum('status', [
                'pending',
                'berhasil',
                'gagal',
                'refund'
            ])->default('pending');

            $table->dateTime('waktu_pembayaran')->nullable();
            $table->string('referensi_gateway', 100)->nullable();

            $table->dateTime('created_at')->useCurrent();

            $table->foreign('id_session')
                ->references('id_session')
                ->on('charging_sessions');
    });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
