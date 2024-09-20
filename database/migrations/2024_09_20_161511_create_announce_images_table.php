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
        Schema::table('announce_images', function (Blueprint $table) {
            $table->string('image_url')->nullable();

            $table->unsignedBigInteger('announce_id')->nullable();
            $table->foreign('announce_id')->references('id')->on('announces')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
