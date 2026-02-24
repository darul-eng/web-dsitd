<?php

declare(strict_types=1);

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
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Replaces 'category' from legacy for better naming
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('news_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('cover_image')->nullable(); // Legacy 'cover'

            // Legacy Compatibility Fields
            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();
            $table->string('publish_at_legacy')->nullable(); // Legacy 'publish_at' was string
            $table->string('updated_by_legacy')->nullable(); // Legacy 'update_by'

            // Modern Standards
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('views_count')->default(0); // Legacy 'views'

            // SEO Fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->string('updated_by')->nullable(); // Modern tracking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_categories');
    }
};
