<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagName;

class ApiTagNameController extends Controller
{
    public function viewAll()
    {
        $tagnames = TagName::all();

        return response()->json([
            'status'=>200,
            'categories'=> $tagnames
        ]);
    }
    public function show($id)
    {
        // try {
        //     $category = TagName::find($id);;

        //     if (!$category) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'tag not found.'
        //         ], 404);
        //     }

        //     return response()->json([
        //         'success' => true,
        //         'data' => $category
        //     ]);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to fetch tag details.',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
        try {
            $category = TagName::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tag not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch tag details.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
