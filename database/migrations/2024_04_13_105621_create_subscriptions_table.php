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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();
//            $table->foreignIdFor(\App\Models\Lesson::class, 'lesson_id')->constrained('lessons');
//            $table->foreignIdFor(\App\Models\Student::class, 'student_id')->constrained('student_id');

            $table->foreignId('lesson_id')->constrained('lessons');
            $table->foreignId('student_id')->constrained('students');
            $table->string('attendance_type')->nullable();//attending, completed, cancelled
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
