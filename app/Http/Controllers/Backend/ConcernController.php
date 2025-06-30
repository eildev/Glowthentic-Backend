<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Concern;
use App\Services\ImageOptimizerService;
use App\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConcernController extends Controller
{
    public function index()
    {
        return view('backend.concern.insert');
    }

    // Concern store function
    public function store(Request $request, ImageOptimizerService $imageService)
    {
        try {
            // Validate the request
            $validate = $request->validate([
                'name' => 'required|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Create a new Concern instance
            $concern = new Concern;
            $concern->name = $request->name;
            $concern->slug = SlugService::generateUniqueSlug($request->name, Concern::class);

            // Handle image upload
            if ($request->hasFile('image')) {
                $destinationPath = public_path('uploads/concern/');
                $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
                $concern->image = 'uploads/concern/' . $imageName;
            }

            // Save the Concern record
            $concern->save();

            return redirect()->back()->with('success', 'Successfully Saved Concern');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., image processing or database errors)
            Log::error('Error saving concern: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save concern: ' . $e->getMessage());
        }
    }

    // tagname View function
    public function view()
    {
        $concerns = Concern::latest()->get();
        return view('backend.concern.view', compact('concerns'));
    }


    // tagname Edit function
    public function edit($id)
    {
        $concern = Concern::findOrFail($id);
        return view('backend.concern.edit', compact('concern'));
    }


    // tagname update function
    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {
        $validate = $request->validate([
            'name' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $concern = Concern::findOrFail($id);
        $concern->name = $request->name;
        $concern->slug = SlugService::generateUniqueSlug($request->name, Concern::class);
        if ($request->hasFile('image')) {
            if ($concern->image) {
                $imagePath = public_path($concern->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $destinationPath = public_path('uploads/concern');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $concern->image = 'uploads/concern/' . $imageName;
        }
        $concern->save();
        return redirect()->route('concern.view')->with('success', 'Concern Successfully updated');
    }


    // tagname Delete function
    public function delete($id)
    {
        $concern = Concern::findOrFail($id);
        if ($concern->image) {
            $imagePath = public_path($concern->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $concern->delete();
        return back()->with('success', 'Concern Successfully deleted');
    }

    public function status($id)
    {
        $concern = Concern::findOrFail($id);
        if ($concern->status == 'inactive') {
            $newStatus = 'active';
        } else {
            $newStatus = 'inactive';
        }

        $concern->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('message', 'status changed successfully');
    }
}
