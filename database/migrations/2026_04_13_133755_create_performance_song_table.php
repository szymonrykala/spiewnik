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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->date('performance_date');
            $table->timestamps();
        });

        Schema::create('performance_songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_id')->constrained()->cascadeOnDelete();
            $table->foreignId('song_id')->constrained()->cascadeOnDelete();
            $table->integer('position')->default(0);
            $table->timestamp('target_date')->nullable();
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->enum('type', ['image', 'audio']);
            $table->morphs('fileable'); // fileable_id + fileable_type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_songs');
        Schema::dropIfExists('performances');
        Schema::dropIfExists('files');
    }
};
