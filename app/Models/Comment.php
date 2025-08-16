<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $attributes = ['is_delete' => 0];
    
    protected $fillable = [
        'post_id',
        'content',
        'author',
        'is_delete'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
