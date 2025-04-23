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
        try {
            $searchTerm = $request->input('q');

            // Fetch up to 10 categories matching the search term
            $categories = Category::where('categoryName', 'like', "%{$searchTerm}%")
                ->take(10) // Limit to 10 categories
                ->get(['id', 'categoryName']);
            $categoryIds = $categories->pluck('id');

            // Fetch up to 10 brands matching the search term
            $brands = Brand::where('BrandName', 'like', "%{$searchTerm}%")
                ->take(10) // Limit to 10 brands
                ->get(['id', 'BrandName']);
            $brandIds = $brands->pluck('id');

            // Fetch up to 10 tags matching the search term
            $tags = TagName::where('tagName', 'like', "%{$searchTerm}%")
                ->take(10) // Limit to 10 tags
                ->get(['id', 'tagName']);
            $tagIds = $tags->pluck('id');

            // Fetch up to 10 products matching the search term or related filters
            $products = Product::with([
                'variants.variantImage',
                'variants.product',
                'variants.productStock',
                // 'variants.promotionproduct',
                'promotionproduct.coupon',
                'variants.productVariantPromotion.coupon',
                'variants.comboProduct',
                'product_tags.tag',
                'promotionproduct.coupon',
                'productStock',
                'productdetails',
                'category.productPromotions.coupon',
                'variantImage'
            ])
                ->where('product_name', 'like', "%{$searchTerm}%")
                ->orWhereIn('category_id', $categoryIds)
                ->orWhereIn('brand_id', $brandIds)
                ->orWhereHas('product_tags', function ($query) use ($tagIds) {
                    $query->whereIn('product_tags.tag_id', $tagIds);
                })
                ->take(10) // Limit to 10 products
                ->get();

            // Return the response with limited results
            return response()->json([
                'products' => $products,
                'searchTerm' => $searchTerm,
                'categories' => $categories,
                'brands' => $brands,
                'message' => count($products) ? 'Search Results Found' : 'No Results Found',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function filter(Request $request)
    {
        try {
            $categoryIds = $request->input('category_id', []);
            $brandIds = $request->input('brand_id', []);
            $tagIds = $request->input('tag_id', []);
            $minPrices = $request->input('min_price', []);
            $maxPrices = $request->input('max_price', []);

            // Ensure we are picking only ONE min and ONE max price
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
                ->where(function ($query) use ($categoryIds, $brandIds, $tagIds) {
                    if (!empty($categoryIds)) {
                        $query->orWhereIn('category_id', $categoryIds);
                    }
                    if (!empty($brandIds)) {
                        $query->orWhereIn('brand_id', $brandIds);
                    }
                    if (!empty($tagIds)) {
                        $query->orWhereHas('product_tags', function ($subQuery) use ($tagIds) {
                            $subQuery->whereIn('product_tags.tag_id', $tagIds);
                        });
                    }
                })
                ->when($minPrice !== null || $maxPrice !== null, function ($query) use ($minPrice, $maxPrice) {
                    $query->whereHas('variants', function ($variantQuery) use ($minPrice, $maxPrice) {
                        if ($minPrice !== null) {
                            $variantQuery->where('regular_price', '>=', $minPrice);
                        }
                        if ($maxPrice !== null) {
                            $variantQuery->where('regular_price', '<=', $maxPrice);
                        }
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
    public function viewAll()
    {
        try {
            $products = Product::orderByDesc('id')->with(
                'variants.variantImage',
                'variants.product',
                'variants.productStock',

                // 'variants.promotionproduct.coupon',
                'variants.productVariantPromotion.coupon',
                'promotionproduct.coupon',
                'variants.comboProduct',
                'product_tags',
                'productStock',
                'productdetails',
                'variantImage',
                'category.productPromotions.coupon',
                'subcategory',
                'brand',
            )->where('status', 1)->get();
            // dd($products);
            return response()->json([
                'status' => '200',
                'message' => 'Product List',
                'data' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Product Not Found',
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function show($slug)
    {
        try {
            $products = Product::with(
                'variants.variantImage',
                'variants.product',
                'variants.productStock',
                'promotionproduct.coupon',
                'variants.productVariantPromotion.coupon',
                'variants.comboProduct',
                'product_tags.tag',
                'productStock',
                'productdetails',
                'variantImage',
                'category.productPromotions.coupon',
                'subcategory',
                'brand',
            )->where('slug', $slug)->first();
            // Debug to check variants and their promotions

            return response()->json([
                'status' => '200',
                'message' => 'Product Search',
                'data' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Product Not Found',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
