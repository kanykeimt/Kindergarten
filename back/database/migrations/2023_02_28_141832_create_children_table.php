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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('surname', 50);
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('group_id');
            $table->date('birth_date');
            $table->string('gender', 10); #MALE FEMALE
            $table->string('photo', 200);
            $table->string('birth_certificate', 200);
            $table->string('med_certificate', 200);
            $table->string('med_disability', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('parent_id');
            $table->foreign('parent_id')
                ->on('users')
                ->references('id')
                ->cascadeOnDelete();

            $table->index('group_id');
            $table->foreign('group_id', 'fk_children_groups_groups1_idx')
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
        Schema::dropIfExists('children');
    }
};
