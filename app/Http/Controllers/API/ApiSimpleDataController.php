<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SimpleData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSimpleDataController extends Controller
{
    public function updateUser(Request $request)
    {
        dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'phone_number' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:10240',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors(),
                    'message' => 'Validation Failed',
                ]);
            }
            $userDetails = new SimpleData();
            $userDetails->full_name = $request->full_name;
            $userDetails->phone_number = $request->phone_number;
            if ($request->hasFile('image')) {
                if ($userDetails->image && file_exists($userDetails->image)) {
                    unlink($userDetails->image);
                }
                $file = $request->file('image');
                $extension = $file->Extension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/user_image/';
                $file->move($path, $filename);
                $userDetails->image = $path . $filename;
            }
            $userDetails->police_station = $request->police_station;
            $userDetails->address = $request->address;
            $userDetails->city = $request->city;
            $userDetails->postal_code = $request->postal_code;
            $userDetails->country = $request->country;
            $userDetails->save();

            return response()->json([
                'status' => 200,
                'user' => $userDetails,
                'message' => 'User Details Updated Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
