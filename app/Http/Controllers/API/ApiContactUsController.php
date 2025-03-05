<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ApiContactUsController extends Controller
{
    public function contactSave(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255',
                'subject' => 'required|string',
                'message' => 'required|string|max:255'
            ]);

            // Check if validation passes
            if ($validator->passes()) {
                // Create a new ContactUs instance and save the data
                $ContactUs = new ContactUs;
                $ContactUs->name = $request->name;
                $ContactUs->email = $request->email;
                $ContactUs->subject = $request->subject;
                $ContactUs->phone = $request->phone;
                $ContactUs->message = $request->message;
                $ContactUs->read = 0;
                $ContactUs->save();

                // Return a successful response
                return response()->json([
                    'status' => 200,
                    'message' => 'Your message sent Successfully'
                ]);
            }

            // Return validation errors if validation fails
            return response()->json([
                'status' => 500,
                'error' => $validator->messages()
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage() // Optional: Include the exception message for debugging
            ]);
        }
    }
}
