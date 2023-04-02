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
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('quantity')->default(1);
            $table->integer('price')->default(0);
            $table->boolean('status')->default(true)->comment('false:not sell, true:sell');
            $table->integer('discount_value')->default(0)->comment('discount money'); 
            $table->string('screen')->nullable();
            $table->string('cpu')->nullable();
            $table->string('gpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('memory')->nullable();
            $table->string('battery')->nullable();
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_options');
    }
};
