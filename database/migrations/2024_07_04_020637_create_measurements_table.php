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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('tailor_id')->references('id')->on('tailors')->cascadeOnDelete();
            $table->decimal('chest', 5, 2);
            $table->decimal('waist', 5, 2);
            $table->decimal('hip', 5, 2);
            $table->decimal('shoulder', 5, 2);
            $table->decimal('sleeve_length', 5, 2);
            $table->decimal('inseam', 5, 2);
            $table->decimal('outseam', 5, 2);
            $table->decimal('neck', 5, 2);
            $table->decimal('bicep', 5, 2);
            $table->decimal('wrist', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
