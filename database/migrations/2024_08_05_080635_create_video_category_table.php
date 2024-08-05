<?php

use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_category', function (Blueprint $table) {
            $table->foreignIdFor(Video::class);
            $table->foreignIdFor(Category::class);
            $table->timestamps();
            $table->primary(['video_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_category');
    }
};
