<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product_Tags;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductFeature;
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
            ->where('parent_id', null)
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take(10)
            ->get();

        //    dd($categories);
        $categoryData = [];
        $uniqueTags = [];
        $uniqueBrands = [];

        foreach ($categories as $category) {

            $subcategories = Category::select('id', 'categoryName', 'slug')
                ->where('parent_id', $category->id)
                ->take(10)
                ->get();
            // $product_feature = Product::select('id', 'slug', 'product_feature')
            //     ->where('category_id', $category->id)
            //     ->take(10)
            //     ->get();

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
                ->take(10)
                ->get();

            // $tagResult = [];
            foreach ($tags as $t) {
                if ($t->tag) {
                    $tagName = $t->tag->tagName;
                    if (!isset($uniqueTags[$tagName])) {
                        $uniqueTags[$tagName] = [
                            'id' => $t->id,
                            'tagName' => $tagName
                        ];
                    }
                }
            }



            $brands = Brand::whereHas('brandProduct', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->selectRaw('MIN(id) as id, brandName, slug')
                ->groupBy('brandName', 'slug')
                ->take(10)
                ->get();

            foreach ($brands as $brand) {
                if (!isset($uniqueBrands[$brand->brandName])) {
                    $uniqueBrands[$brand->brandName] = [
                        'id' => $brand->id,
                        'brandName' => $brand->brandName,
                        'slug' => $brand->slug
                    ];
                }
            }


            $categoryData[] = [
                'id' => $category->id,
                'categoryName' => $category->categoryName,
                'slug' => $category->slug,
                'products_count' => $category->products_count,
                'product_feature' => $product_feature,
                'subcategories' => $subcategories,
                'tags' => array_values($uniqueTags),
                'brands' => array_values($uniqueBrands)
            ];
        }
        // $finalTags = array_values(array_slice($uniqueTags, 0, 10));
        // $finalBrands = array_values(array_slice($uniqueBrands, 0, 10));
        return response()->json([
            'status' => 200,
            'categories' => $categoryData,
            // 'finalTags' => $finalTags,
            // 'finalBrands' => $finalBrands
        ]);
    }
}
