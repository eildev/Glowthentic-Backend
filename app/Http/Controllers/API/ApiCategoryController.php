<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product_Tags;
use App\Models\Brand;
use App\Models\Product;
class ApiCategoryController extends Controller
{
    public function view()

    {
        $categories = Category::all();

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

    // public function navCategoryShow()
    // {
    //     $categories = Category::select('id', 'categoryName', 'slug')
    //     ->withCount('products')
    //     ->orderByDesc('products_count')
    //     ->take(10)
    //     ->get();
    //     $subcategories = [];
    //     foreach ($categories as $category) {
    //         $subcategories[$category->id] = Category::select('id', 'categoryName', 'slug')
    //             ->where('parent_id', $category->id)
    //             ->take(10)
    //             ->get();
    //     }

    //     $tag = Product_Tags::whereHas('product', function ($query) use ($categories) {
    //         $query->whereIn('category_id', $categories->pluck('id'));
    //     })
    //     ->selectRaw('MIN(id) as id, tag_id')
    //     ->groupBy('tag_id')
    //     ->take(10)
    //     ->get();




    // $tagData = [];

    // foreach ($tag as $t) {
    //     if ($t->tag) {
    //         $tagName = $t->tag->tagName;
    //         if (!isset($tagData[$tagName])) {
    //             $tagData[$tagName] = $t->id;
    //         }
    //     }
    // }


    // $tagResult = [];
    // foreach ($tagData as $name => $id) {
    //     $tagResult[] = [
    //         'id' => $id,
    //         'tagName' => $name
    //     ];
    // }

    // $Brand = Brand::whereHas('brandProduct', function ($query) use ($categories) {
    //     $query->whereIn('category_id', $categories->pluck('id'));
    // })
    // ->selectRaw('MIN(id) as id, brandName, slug') // Select first occurrence
    // ->groupBy('brandName', 'slug') // Group by unique brand attributes
    // ->take(10)
    // ->get();


    //     $BrandData= [];
    //     foreach($Brand as $brand){
    //         if(!isset($BrandData[$brand->brandName])){
    //             $BrandData[$brand->brandName] = $brand->id;
    //         }
    //     }

    //     $BrandResult = [];
    //     foreach ($BrandData as $name => $id) {
    //         $BrandResult[] = [
    //             'id' => $id,
    //             'brandName' => $name,
    //             'slug' => $brand->slug
    //         ];
    //     }

    //      return response()->json([
    //         'status' => 200,
    //         'categories' => $categories,
    //         'subcategories' => $subcategories,
    //         'tag' => $tagResult,
    //         'brand' => $BrandResult
    //     ]);
    // }

    public function navCategoryShow()
    {

        $categories = Category::select('id', 'categoryName', 'slug')
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take(10)
            ->get();

        $categoryData = [];
        $uniqueTags = [];
        $uniqueBrands = [];

        foreach ($categories as $category) {

            $subcategories = Category::select('id', 'categoryName', 'slug')
                ->where('parent_id', $category->id)
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
                'subcategories' => $subcategories,
                'tags' => array_values($uniqueTags),
                'brands' => array_values($uniqueBrands)
            ];
        }

        return response()->json([
            'status' => 200,
            'categories' => $categoryData
        ]);
    }


}
