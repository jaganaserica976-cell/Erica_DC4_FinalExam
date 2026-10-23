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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('set null'); 
            $table->foreignId('class_id')->nullable()->constrained('school_classes')->onDelete('set null');
            $table->decimal('prelimgrade', 5, 2)->nullable();
            $table->decimal('midtermgrade', 5, 2)->nullable();
            $table->decimal('final_average', 5, 2)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();


            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
