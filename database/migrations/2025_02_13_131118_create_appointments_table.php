<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by_id')->constrained('users')->onDelete('cascade'); // Ki hozta létre az időpontot
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Ki foglalta le az időpontot
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Melyik kurzushoz tartozik
            $table->dateTime('appointment_time'); // A foglalás időpontja
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
