<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $products = Product::where('category_id', Category::whereSlug($slug)->first()->id)->paginate(15);
        return view('web.products.category.index', ['products' => $products]);
    }
}