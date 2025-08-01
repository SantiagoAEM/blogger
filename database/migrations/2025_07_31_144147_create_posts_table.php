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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->mediumText('content');
            $table->string('image_path')->nullable();

            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('category_id')
            ->constrained()
            ->onDelete('cascade');

            $table->boolean('is_published')
            ->default(false);
            $table->timestamp('published_at')
            ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
