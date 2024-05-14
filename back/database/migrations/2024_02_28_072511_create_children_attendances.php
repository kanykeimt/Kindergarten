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
        Schema::create('children_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->date('date');
            $table->json('attendance');
            $table->timestamps();

            $table->index('group_id');
            $table->foreign('group_id', 'fk_children_attendances_groups1_idx')
                ->on('groups')
                ->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_attendances');
    }
};
