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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
