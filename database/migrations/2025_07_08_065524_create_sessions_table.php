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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id('session_id');
            $table->unsignedBigInteger('event_id')->index();
            $table->string('title', 150);
            $table->string('speaker', 100);
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->timestamps();

            $table->foreign('event_id')->references('event_id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
