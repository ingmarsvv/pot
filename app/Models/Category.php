<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    //protected $fillable = ['id', 'cat_name'];
    protected $fillable = ['cat_name', 'image', 'description'];

    public function videos(): BelongsToMany{
        return $this->belongsToMany(Video::class, 'category_video')->withTimestamps();
    }

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class, 'category_user')->withTimestamps();
    }

}
