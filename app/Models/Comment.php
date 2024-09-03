<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['text', 'user_id', 'video_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
    


}
