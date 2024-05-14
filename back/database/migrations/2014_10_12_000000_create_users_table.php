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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('address', 200);
            $table->string('phone_number', 20);
            $table->string('email')->unique();
            $table->string('profile_photo', 200)->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('passport_front',200)->nullable();
            $table->string('passport_back',200)->nullable();
            $table->integer('amount_of_child')->default(0);
            $table->unsignedBigInteger('role');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index('role');
            $table->foreign('role')
                ->on('roles')
                ->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
