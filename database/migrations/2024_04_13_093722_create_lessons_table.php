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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->json('characteristics')->nullable();
            $table->text('description')->nullable();
            $table->text('poster')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->time('start_time')->nullable();//only hours and minutes
            $table->time('end_time')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->unsignedSmallInteger('capacity')->nullable();
            $table->enum('day_of_week',['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
