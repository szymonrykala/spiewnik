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
        Schema::create('song', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('links')->nullable();
            $table->boolean('is_public')->default(true);
            $table->foreignId('updated_by')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('tag', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('tag')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('song_tag', function (Blueprint $table) {
            $table->foreignId('song_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();

            $table->primary(['song_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_tag');
    }
};
