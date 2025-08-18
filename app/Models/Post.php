<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(PostObserver::class)]

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable =[
        'title',
        'slug',
        'excerpt',
        'content',
        'image_path',
        'user_id',
        'category_id',
        'is_published',
        'published_at',
    ];
    protected $casts = [
        'is_published'=> 'boolean',
        'published_at'=>'datetime',
    ];

    protected function image():Attribute{//accesor
        return Attribute::make(
            get: fn() => $this->image_path ? Storage::url($this->image_path) : 'https://as1.ftcdn.net/v2/jpg/08/30/64/70/1000_F_830647061_m02NGMtYotrjinuMU9RcAMuijUZX1k07.jpg'
        );
    }

    public function getRouteKeyName(){ // Método para definir el campo que se usará en las rutas
  
        return 'slug'; // Utiliza el campo 'slug' para las rutas
    }

    public function tags(){
        return  $this->belongsToMany(Tag::class);
    }
}