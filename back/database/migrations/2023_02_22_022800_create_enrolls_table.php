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
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('surname',50);
            $table->unsignedBigInteger('parent_id');
            $table->date('birth_date');
            $table->string('gender'); //MALE, FEMALE
            $table->string('birth_certificate',200);
            $table->string('med_certificate',200);
            $table->string('med_disability', 200)->nullable();
            $table->string('photo',200);
            $table->timestamps();

            $table->index('parent_id');
            $table->foreign('parent_id')
                ->on('users')
                ->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolls');
    }
};
