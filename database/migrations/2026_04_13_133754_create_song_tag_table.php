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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('lyrics')->nullable();
            $table->string('yt_link')->nullable();
            $table->string('ms_link')->nullable();
            $table->string('photo_url')->nullable();
            $table->boolean('is_public')->default(true);
            $table->foreignId('updated_by')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('tags')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('song_tag', function (Blueprint $table) {
            $table->foreignId('song_id')->constrained('songs')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();

            $table->primary(['song_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('songs');
    }
};
