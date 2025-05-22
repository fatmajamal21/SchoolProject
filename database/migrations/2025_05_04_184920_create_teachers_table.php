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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('date_of_birth');
            $table->string('university_major');
            $table->enum('academic_qualification', ['diploma', 'bachelors', 'master', 'phD']);
            $table->enum('gender', ['male', 'female']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('date_of_appointment');
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
