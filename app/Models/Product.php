<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'max_to_buy',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
    public function getRouteKeyName()
    {
    return 'slug';
    }

}
