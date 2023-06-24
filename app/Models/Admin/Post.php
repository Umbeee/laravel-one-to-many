<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    public static function titleToSlug($title){
        return Str::slug($title, '-');
    }

    protected $fillable = [ 'title', 'content', 'slug', 'cover_image' ];
}
