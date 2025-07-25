<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product_Tags;
use App\Models\Brand;
use App\Models\ProductFeature;
use Exception;

class ApiCategoryController extends Controller
{
    public function view()
    {
        // $categories = Category::where('parent_id', null)->where('status', 1)->get();
        $categories = Category::where('status', 1)->get();

        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);
            // dd($category);
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch category details.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function navCategoryShow()
    {
        $categories = Category::select('id', 'categoryName', 'slug')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take(10)
            ->get();

        $categoryData = [];

        foreach ($categories as $category) {


            $subcategories = Category::select('id', 'categoryName', 'slug')
                ->where('parent_id', $category->id)
                ->take(10)
                ->get();


            $product_feature = ProductFeature::whereHas('product', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->selectRaw('MIN(id) as id, feature_id')
                ->groupBy('feature_id')
                ->with('feature')
                ->take(10)
                ->get();


            $tags = Product_Tags::whereHas('product', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->selectRaw('MIN(id) as id, tag_id')
                ->groupBy('tag_id')
                ->with('tag')
                ->take(10)
                ->get();

            $uniqueTags = [];
            foreach ($tags as $t) {
                if ($t->tag) {
                    $tagName = $t->tag->tagName;
                    if (!isset($uniqueTags[$tagName])) {
                        $uniqueTags[$tagName] = [
                            'id' => $t->tag->id,
                            'tagName' => $tagName
                        ];
                    }
                }
            }


            $brands = Brand::whereHas('brandProduct', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->select('id', 'brandName', 'slug')
                ->groupBy('id', 'brandName', 'slug')
                ->take(10)
                ->get();

            $uniqueBrands = [];
            foreach ($brands as $brand) {
                $uniqueBrands[] = [
                    'id' => $brand->id,
                    'brandName' => $brand->brandName,
                    'slug' => $brand->slug
                ];
            }

            // Combine all data for this category
            $categoryData[] = [
                'id' => $category->id,
                'categoryName' => $category->categoryName,
                'slug' => $category->slug,
                'products_count' => $category->products_count,
                'product_feature' => $product_feature,
                'subcategories' => $subcategories,
                'tags' => array_values($uniqueTags),
                'brands' => $uniqueBrands
            ];
        }

        // Return final response
        return response()->json([
            'status' => 200,
            'categories' => $categoryData
        ]);
    }
}
