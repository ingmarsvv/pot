<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'video_file', 'description'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_video')->withTimestamps();
        
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function scopeFilterByCategory($query, $categoryName)
    {
        return $query->whereHas('categories', function ($q) use ($categoryName) {
            $q->where('cat_name', $categoryName);
        });
    }
}
