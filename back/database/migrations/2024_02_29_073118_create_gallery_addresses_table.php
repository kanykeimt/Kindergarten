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
        Schema::create('gallery_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('gallery_id');
            $table->timestamps();

            $table->index('group_id');
            $table->foreign('group_id', 'fk_gallery_addresses_group')
                ->on('groups')
                ->references('id')
                ->cascadeOnDelete();

            $table->index('gallery_id');
            $table->foreign('gallery_id')
                ->on('gallery')
                ->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_addresses');
    }
};
