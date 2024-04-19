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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('user_identifier')->constrained()->onDelete('cascade');
            $table->string('user_identifier')->unique()->comment('Identifier of the user')->index();
            $table->string('short_info')->nullable();
            $table->text('about')->nullable();
            $table->timestamp('experience_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
