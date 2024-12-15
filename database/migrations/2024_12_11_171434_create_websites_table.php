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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name');
            $table->decimal('cost_price');
            $table->decimal('retail_price');
            $table->decimal('margin');
            $table->string('supplier_email');
            $table->string('pictures')->nullable();
            $table->string('ip_address')->nullable();
            $table->boolean('follow')->default(true);
            $table->boolean('sponsored_tag')->default(false);
            $table->integer('backlinks')->default(1);
            $table->string('main_country')->nullable();
            $table->string('delete_reason')->nullable();
            $table->string('blog_duration')->default('permanent');
            $table->string('write_content')->default('dng');
            $table->integer('minimal_words')->default(500);
            $table->string('website_type')->default('blog');
            $table->string('dng_requirements')->nullable();
            $table->string('content_requirements')->nullable();
            $table->string('supplier_requirements')->nullable();
            $table->foreignId('website_zone_id');
            $table->timestamps();

            $table->foreign('website_zone_id')->references('id')->on('website_zones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
