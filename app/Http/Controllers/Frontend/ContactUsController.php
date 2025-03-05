<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @dd($request->all());
        // return response()->json([
        //     'Request' => $request->all()

        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string|max:255'
        ]);
        if ($validator->passes()) {
            $ContactUs = new ContactUs;
            $ContactUs->name = $request->name;
            $ContactUs->email = $request->email;
            $ContactUs->subject = $request->subject;
            $ContactUs->phone = $request->phone;
            $ContactUs->message = $request->message;
            $ContactUs->read = 0;
            $ContactUs->save();

            return response()->json([
                'status' => 200,
                'message' => 'Your message sent Successfully'
            ]);
        }
        return response()->json([
            'status' => '500',
            'error' => $validator->messages()
        ]);
    }

    /**
     * Display the specified resource.
     */

    public function show()
    {

        $contact_us = ContactUs::where('read', '0')->get();
        return view('backend.contacts.message_list', compact('contact_us'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


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
