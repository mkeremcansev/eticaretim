<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewCacheProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $with = ['getOneProductAttributes', 'getOneProductImages', 'getAllProductReviews'];
        Cache::remember('r_categories', 60 * 60, function () {
            return  Category::with('getAllCategoryProducts')->inRandomOrder()->get();
        });
        Cache::remember('r_products', 60 * 60, function () use ($with) {
            return Product::with($with)->whereStatus(1)->inRandomOrder()->limit(10)->get();
        });
        Cache::remember('n_products', 60 * 60, function () use ($with) {
            return Product::with($with)->whereStatus(1)->where('created_at', '>=', Carbon::today())->limit(10)->get();
        });
        Cache::remember('d_products', 60 * 60, function () use ($with) {
            return
                Product::with($with)->whereStatus(1)->whereHas('getOneProductAttributes', function ($query) {
                    $query->where('discount', '!=', null);
                })->limit(10)->get();
        });
        Cache::remember('p_products', 60 * 60, function () use ($with) {
            return
                Product::with($with)->whereStatus(1)->whereHas('getAllProductReviews', function ($query) {
                    $query->select('product_id')->groupBy('product_id')->havingRaw('avg(rating) >= 4');
                })->limit(10)->get();
        });
        Cache::remember('r_campaigns', 60 * 60, function () {
            return
                Campaign::whereStatus(1)->inRandomOrder()->limit(6)->get();
        });
    }
}