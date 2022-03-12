<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::whereStatus(1)->with([
            'getOneProductAttributes',
            'getOneProductSeoAttributes',
            'getAllProductImages',
            'getAllProductInformations',
            'getAllProductVariants.getAllVariantAttributes',
            'getOneProductBrand',
            'getOneProductCategory',
            'getAllProductReviews.getOneReviewUser',
            'getAllProductAuthReviews'
        ])->whereHas('getOneProductAttributes', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->firstOrFail();
        return view('web.product.index', ['product' => $product]);
    }
}
