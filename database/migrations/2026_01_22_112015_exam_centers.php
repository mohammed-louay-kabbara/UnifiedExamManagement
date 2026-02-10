<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('exam_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('governorate');
            $table->string('location');
            $table->integer('amount');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        
    }
};
