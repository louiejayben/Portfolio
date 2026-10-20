<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            // Portfolio owner
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Public sharing URL token
            $table->string('public_token', 48)->unique();

            // Personal information
            $table->string('full_name');
            $table->string('photo_path')->nullable();
            $table->string('email');
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();

            // About and qualifications
            $table->text('about_me')->nullable();
            $table->text('education')->nullable();
            $table->text('skills')->nullable();

            // Project information
            $table->text('project')->nullable();
            $table->string('project_link')->nullable();

            // Work experience
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->text('work_description')->nullable();

            // Social and website links
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();

            // Template selection
            $table->string('template', 30)->default('modern');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};