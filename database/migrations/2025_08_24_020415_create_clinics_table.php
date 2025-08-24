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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('cnpj', 18);
            $table->string('address', 255);
            $table->string('city', 100);
            $table->string('zip_code', 10);
            $table->string('phone', 20);
            $table->string('email', 255);
            $table->integer('number_of_available_offices');
            $table->integer('average_consultation_duration_minutes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
