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
        Schema::create('website_ratings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ahrefs_updated');
            $table->integer('ahrefs_domain_rating');
            $table->integer('ahrefs_referring_domains');
            $table->integer('ahrefs_url_rating');
            $table->integer('ahrefs_linked_domains');
            $table->integer('majestic_citation_flow');
            $table->integer('majestic_trust_flow');
            $table->integer('moz_domain_authority');
            $table->integer('moz_spam_score');
            $table->foreignId('website_id');
            $table->timestamps();

            $table->foreign('website_id')->references('id')->on('websites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_ratings');
    }
};
