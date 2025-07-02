<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Concern;
use Exception;
use Illuminate\Http\Request;

class ApiConcernController extends Controller
{
    public function viewAll()
    {
        $concerns = Concern::where('status', 'active')->get();

        return response()->json([
            'status' => 200,
            'concerns' => $concerns
        ]);
    }

    public function show($id)
    {
        try {
            $concern = Concern::findOrFail($id);

            return response()->json([
                'success' => true,
                'concern' => $concern
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
