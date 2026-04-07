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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('cpu');
            $table->string('ram');
            $table->string('storage');
            $table->string('gpu');
            $table->string('screen');
            $table->string('os');
            $table->string('battery');
            $table->string('camera');
            $table->string('connect');
            $table->string('other_function');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
