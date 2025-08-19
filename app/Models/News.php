<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class News extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'slug', 'body', 'date'];
    protected $casts = [
        'date' => 'date',
    ];


    public function images()
    {
        return $this->hasMany(NewsImages::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }
}
