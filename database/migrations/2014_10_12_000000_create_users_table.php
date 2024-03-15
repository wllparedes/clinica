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
            $table->string('names');
            $table->string('paternal');
            $table->string('maternal');
            $table->string('dni')->unique();
            $table->string('phone_number');
            $table->string('emergency_phone_number')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->char('gender', 1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('available')->default(1);
            $table->boolean('status')->default(1);
            $table->string('role')->default('patient');
            // $table->foreignId('current_team_id')->nullable();
            // $table->string('profile_photo_path', 2048)->nullable();
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
