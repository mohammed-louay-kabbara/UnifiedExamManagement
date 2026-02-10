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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->enum('type', ['text','image']);
            $table->enum('difficulty', ['easy', 'medium', 'hard'])
                ->default('medium');
            $table->foreignId('year_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('professor_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('exam_cycle_id')
                ->constrained('exam_cycles')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
