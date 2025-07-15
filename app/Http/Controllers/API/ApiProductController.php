<?php

namespace App\Http\Controllers\API;

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Combo;
use App\Models\TagName;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('q');

            // Validate search term
            if (empty($searchTerm)) {
                return response()->json([
                    'message' => 'Search term is required.',
                    'products' => [],
                    'searchTerm' => $searchTerm,
                    'categories' => [],
                    'brands' => [],
                ], 400);
            }

            // Fetch up to 10 categories matching the search term
            $categories = Category::where('categoryName', 'like', "%{$searchTerm}%")
                ->take(10)
                ->get(['id', 'categoryName']);
            $categoryIds = $categories->pluck('id');

            // Fetch up to 10 brands matching the search term
            $brands = Brand::where('BrandName', 'like', "%{$searchTerm}%")
                ->take(10)
                ->get(['id', 'BrandName']);
            $brandIds = $brands->pluck('id');

            // Fetch up to 10 tags matching the search term
            $tags = TagName::where('tagName', 'like', "%{$searchTerm}%")
                ->take(10)
                ->get(['id', 'tagName']);
            $tagIds = $tags->pluck('id');

            // Fetch up to 10 products with dynamic sorting
            $products = Product::with([
                'variants.variantImage',
                'variants.product',
                'variants.productStock',
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
                ->where(function ($query) use ($searchTerm, $categoryIds, $brandIds, $tagIds) {
                    $query->where('product_name', 'like', "%{$searchTerm}%")
                        ->orWhereIn('category_id', $categoryIds)
                        ->orWhereIn('brand_id', $brandIds)
                        ->orWhereHas('product_tags', function ($subQuery) use ($tagIds) {
                            $subQuery->whereIn('product_tags.tag_id', $tagIds);
                        });
                })
                ->orderByRaw("CASE WHEN product_name LIKE ? THEN 0 ELSE 1 END, product_name ASC", ["{$searchTerm}%"])
                ->take(10)
                ->get();

            // Return the response with limited results
            return response()->json([
                'products' => $products,
                'searchTerm' => $searchTerm,
                'categories' => $categories,
                'brands' => $brands,
                'message' => $products->isNotEmpty() ? 'Search Results Found' : 'No Results Found',
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
                'comboproduct',
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
    // public function viewAll()
    // {
    //     try {
    //         // Fetch products with related data
    //         $products = Product::orderByDesc('id')->with([
    //             'variants.variantImage',
    //             'variants.product',
    //             'variants.productStock',
    //             'variants.productVariantPromotion.coupon',
    //             'promotionproduct.coupon',
    //             'variants.comboProduct',
    //             'product_tags',
    //             'productStock',
    //             'productdetails',
    //             'variantImage',
    //             'category.productPromotions.coupon',
    //             'subcategory',
    //             'brand',
    //         ])->where('status', 1)->get();

    //         // Fetch combos with related data
    //         $combos = Combo::with([
    //             'comboproduct.product',
    //             'comboproduct.product.subcategory',
    //             'comboproduct.product.brand',
    //             'comboproduct.product.category.productPromotions.coupon',
    //             'comboproduct.product.productdetails',
    //             'comboproduct.product.productStock',
    //             'comboproduct.product.product_tags',
    //             'comboproduct.product.promotionproduct.coupon',
    //             'comboproduct.variant',
    //             'comboproduct.variant.variantImage',
    //             'comboproduct.variant.productStock',
    //             'comboimage',
    //         ])->where('status', 'active')->get();

    //         // Transform products to include a 'type' field
    //         $products = $products->map(function ($product) {
    //             return array_merge($product->toArray(), ['type' => 'product']);
    //         });

    //         // Transform combos to include a 'type' field
    //         $combos = $combos->map(function ($combo) {
    //             return array_merge($combo->toArray(), ['type' => 'combo']);
    //         });

    //         // Merge the collections into a single array
    //         $combinedData = $products->concat($combos)->values();

    //         return response()->json([
    //             'status' => '200',
    //             'message' => 'Product and Combo List',
    //             'data' => $combinedData,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => '500',
    //             'message' => 'Data Retrieval Failed',
    //             'error' => $e->getMessage(),
    //         ]);
    //     }
    // }


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
                'reviews',
                'comboproduct',
                'comboproduct.variant',
                'comboproduct.combo',
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
