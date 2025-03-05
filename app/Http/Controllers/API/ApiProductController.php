<?php

namespace App\Http\Controllers\API;

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\TagName;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function search(Request $request)
    {
        try{
            $searchTerm = $request->input('q');

            $categoryIds = Category::where('categoryName', 'like', "%{$searchTerm}%")->pluck('id');


            $brandIds = Brand::where('BrandName', 'like', "%{$searchTerm}%")->pluck('id');

            $tagIds = TagName::where('tagName', 'like', "%{$searchTerm}%")->pluck('id');


            $products = Product::where('product_name', 'like', "%{$searchTerm}%")
                ->with('variants.variantImage', 'product_tags.tag', 'productStock', 'productdetails', 'variantImage')
                ->orWhereIn('category_id', $categoryIds)
                ->orWhereIn('brand_id', $brandIds)
                ->orWhereHas('product_tags', function ($query) use ($tagIds) {
                    $query->whereIn('product_tags.tag_id', $tagIds);
                })
                ->get();

            return response()->json([
                'products' => $products,
                'searchTerm' => $searchTerm,
                'categoryIds' => $categoryIds,
                'message' => count($products) ? 'Search Results Found' : 'No Results Found',
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function filter(Request $request) {
        try {
            $categoryIds = $request->input('category_id', []);
            $brandIds = $request->input('brand_id', []);
            $tagIds = $request->input('tag_id', []);
            $minPrices = $request->input('min_price', []);
            $maxPrices = $request->input('max_price', []);

            $minPrice = !empty($minPrices) ? min($minPrices) : null;
            $maxPrice = !empty($maxPrices) ? max($maxPrices) : null;

            $product = Product::with([
                'variants' => function ($query) {
                    $query->orderBy('regular_price', 'asc');
                },
                'variants.variantImage',
                'product_tags.tag',
                'productStock',
                'productdetails',
                'variantImage'
            ])
            ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->when(!empty($brandIds), function ($query) use ($brandIds) {
                $query->whereIn('brand_id', $brandIds);
            })
            ->when(!empty($tagIds), function ($query) use ($tagIds) {
                $query->whereHas('product_tags', function ($query) use ($tagIds) {
                    $query->whereIn('product_tags.tag_id', $tagIds);
                });
            })
            ->when(!empty($minPrice) && !empty($maxPrice), function ($query) use ($minPrice, $maxPrice) {
                $query->whereHas('variants', function ($variantQuery) use ($minPrice, $maxPrice) {
                    $variantQuery->whereBetween('regular_price', [$minPrice, $maxPrice]);
                });
            })
            ->get()
            ->map(function ($product) {
                $product->lowest_price = $product->variants->min('regular_price');
                return $product;
            });

            return response()->json([
                'products' => $product,
                'categoryIds' => $categoryIds,
                'brandIds' => $brandIds,
                'tagIds' => $tagIds,
                'minPrice' => $minPrice,
                'maxPrice' => $maxPrice,
                'message' => count($product) ? 'Filter Results Found' : 'No Results Found',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}


