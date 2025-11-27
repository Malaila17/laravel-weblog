<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = ['title', 'content'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
}
