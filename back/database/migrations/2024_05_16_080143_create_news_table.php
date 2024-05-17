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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('media_id');
            $table->string('text', 200)->nullable();
            $table->timestamps();

            $table->index('group_id');
            $table->foreign('group_id', 'fk_news_group')
                ->on('groups')
                ->references('id')
                ->cascadeOnDelete();

            $table->index('media_id');
            $table->foreign('media_id', 'fk_news_media')
                ->on('media')
                ->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
