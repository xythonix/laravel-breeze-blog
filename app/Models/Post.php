<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function Author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
