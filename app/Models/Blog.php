<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory, Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul_blog'
            ]
        ];
    }

    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
