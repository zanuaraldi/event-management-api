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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->unsignedBigInteger('organizer_id')->index();
            $table->string('title');
            $table->string('description');
            $table->boolean('is_private');
            $table->string('location', 150);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('organizer_id')->references('organizer_id')->on('organizers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
