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
        Schema::create('teacher_syllabus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Teacher::class, 'teacher_id')->constrained('teachers');
            $table->foreignIdFor(\App\Models\Section::class, 'section_id')->constrained('sections');

//            $table->foreignId('teacher_id')->constrained('teachers')->nullOnDelete();
//            $table->foreignId('section_id')->constrained('sections')->nullOnDelete();
            $table->text('content')->nullable();
            $table->text('syllabus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_syllabus');
    }
};
