<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $trending_products=Product::with('category')->where('trending',1)->where('status',1)->get();
        return view('frontend.index' ,compact('trending_products'))->with('categoryName', Category::pluck('name'));
    }

    public function categories()
    {
        $categories = Category::select('id','slug','name', 'description', 'image')->withCount('products')->get();
        return view('frontend.categories', compact('categories'));
    }

    public function category(Category $slug)
    {
        $category =  $slug;
        $products = Product::whereCategoryId($category->id)->whereStatus(1)->latest()->simplePaginate(15);
        //$products = Product::where('category_id', $category->id)->where('status', 1)->latest()->simplePaginate(15);
        return view('frontend.category', ['products' => $products, 'category' => $category]);
    }

    public function product(Product $slug)
    {
        $product = $slug;
        return view('frontend.product', ['product' => $product]);
    }
}