r
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
        Schema::create('tailor_with_type', function (Blueprint $table) {
            $table->foreignId('tailor_id')->references('id')->on('tailors')->cascadeOnDelete();
            $table->foreignId('tailor_type_id')->references('id')->on('tailor_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tailor_with_type');
    }
};
