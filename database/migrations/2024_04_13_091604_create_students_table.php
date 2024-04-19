<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('user_identifier')->constrained()->onDelete('cascade');
            $table->string('user_identifier')->unique()->comment('Identifier of the user')->index();

            $table->string('status')->default('allowed');
            $table->string('gpa')->nullable();
            $table->string('degree')->nullable();
            $table->string('group')->nullable();
            $table->tinyInteger('course_year')->nullable();
            $table->boolean('gender')->nullable();
            $table->integer('attendance_count')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
