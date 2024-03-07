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
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->string('location');
            $table->integer('availableSeats');
            $table->integer('takenSeats');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->integer('reservationMethod');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organizer_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); 
            $table->timestamps();
            $table->softDeletes();
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
