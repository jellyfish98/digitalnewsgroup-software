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
        Schema::create('backlink_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name');
            $table->integer('majestic_referring_domains');
            $table->integer('majestic_trust_flow');
            $table->integer('majestic_citation_flow');
            $table->dateTime('first_seen');
            $table->dateTime('last_seen');
            $table->string('ip_address');
            $table->string('country');
            $table->foreignId('project_domain_id');
            $table->timestamps();

            $table->foreign('project_domain_id')->references('id')->on('project_domains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlink_profiles');
    }
};
