<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
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
}
