<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'popular',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getRouteKeyName()
    {
    return 'slug';
    }


}
