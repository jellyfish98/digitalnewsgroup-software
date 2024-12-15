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
        Schema::create('order_comments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->foreignId('order_id');
            $table->foreignId('user_id');
            $table->dateTime('edited_at')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_comments');
    }
};
