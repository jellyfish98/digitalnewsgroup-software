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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('new');
            $table->json('anchor_pairs')->nullable();
            $table->foreignId('company_id');
            $table->foreignId('project_id');
            $table->foreignId('website_id');
            $table->foreignId('project_domain_id');
            $table->foreignId('order_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('website_id')->references('id')->on('websites');
            $table->foreign('project_domain_id')->references('id')->on('project_domains');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
