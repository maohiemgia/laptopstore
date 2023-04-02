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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('name')->default('new_user');
            $table->text('password');
            $table->text('image')->default('user_avatar.jpg')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('role')->default(false)->comment('false: user, true: admin');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
