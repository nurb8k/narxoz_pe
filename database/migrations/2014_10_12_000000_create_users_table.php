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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique()->comment('Unique identifier for the user')->index()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('fcm')->nullable();
            $table->text('avatar')->nullable()->default('default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
