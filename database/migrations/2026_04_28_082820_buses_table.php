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
    Schema::create('buses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
        $table->string('plate_number')->unique();
        $table->enum('bus_type', ['large', 'small']);
        $table->integer('capacity');
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
