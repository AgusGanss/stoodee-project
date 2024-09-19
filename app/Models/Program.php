<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Program extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul_program'
            ]
        ];
    }

    protected $guarded = [];

    public function mail(){
        return $this->hasMany(Mail::class);
    }

    public function iklandalam(){
        return $this->hasMany(IklanDalam::class);
    }
}
