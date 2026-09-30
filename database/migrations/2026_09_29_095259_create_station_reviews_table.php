<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('station_reviews', function (Blueprint $table) {

            $table->id('id_review');

            $table->unsignedBigInteger('id_location');

            $table->unsignedBigInteger('id_user');

            $table->unsignedTinyInteger('rating');

            $table->text('ulasan')->nullable();

            $table->timestamps();

            $table->foreign('id_location')
                ->references('id_location')
                ->on('locations')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->unique([
                'id_location',
                'id_user'
    ]);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('station_reviews');
    }
};