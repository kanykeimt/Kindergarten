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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->date('date');
            $table->string('message', 500);
            $table->integer('message_status'); #0-delivered, 1-read
            $table->timestamps();

            $table->index('from_user_id');
            $table->foreign('from_user_id')
                ->on('users')
                ->references('id')
                ->cascadeOnDelete();

            $table->index('to_user_id');
            $table->foreign('to_user_id')
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
        Schema::dropIfExists('chats');
    }
};
