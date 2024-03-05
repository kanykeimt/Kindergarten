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
//        class_id
//group_id
//day
//time_from
//time_to
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classes_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('day');
            $table->time('time_from');
            $table->time('time_to');
            $table->timestamps();

            $table->index('classes_id');
            $table->foreign('classes_id')
                ->on('classes')
                ->references('id')
                ->cascadeOnDelete();

            $table->index('group_id');
            $table->foreign('group_id')
                ->on('groups')
                ->references('id')
                ->cascadeOnDelete();

            $table->index('day');
            $table->foreign('day')
                ->on('days_of_week')
                ->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
