<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TagName;
use Exception;
use App\Services\SlugService;

class TagNameController extends Controller
{

    // tagname index function
    public function index()
    {
        return view('backend.tagname.insert');
    }

    // tagname store function
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tagname' => 'required|max:100',
            ]);

            $tagname = new TagName;
            $tagname->tagName = $request->tagname;
            $tagname->slug = SlugService::generateUniqueSlug($request->tagname, TagName::class);
            $tagname->save();

            return redirect()->back()->with('success', 'Successfully Saved Tag');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to save tag: ' . $e->getMessage());
        }
    }


    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'tagName' => 'required|max:100',
            ]);

            $tagname = new TagName;
            $tagname->tagName = $request->tagName;
            $tagname->slug = SlugService::generateUniqueSlug($request->tagName, TagName::class);
            $tagname->save();

            return response()->json([
                'status' => 200,
                'message' => 'Tag Saved Successfully',
                'data' => $tagname
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to save tag: ' . $e->getMessage()
            ], 500);
        }
    }



    // tagname View function
    public function view()
    {
        $tagnames = TagName::get();
        return view('backend.tagname.view', compact('tagnames'));
    }

    public function show()
    {
        $tagnames = TagName::where('status', 'active')->latest()->get();
        return response()->json([
            'status' => 200,
            'data' => $tagnames
        ]);
    }

    // tagname Edit function
    public function edit($id)
    {
        try {
            $tagname = TagName::findOrFail($id);
            return view('backend.tagname.edit', compact('tagname'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load tag: ' . $e->getMessage());
        }
    }


    // tagname update function
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tagname' => 'required|max:100',
            ]);

            $tagname = TagName::findOrFail($id);
            $tagname->tagName = $request->tagname;
            $tagname->slug = SlugService::generateUniqueSlug($request->tagname, TagName::class, 'slug', $id);
            $tagname->save();

            return redirect()->route('tagname.view')->with('success', 'Tag Successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update tag: ' . $e->getMessage());
        }
    }


    // tagname Delete function
    public function delete($id)
    {
        $tagname = TagName::findOrFail($id);
        $tagname->delete();
        return back()->with('success', 'Tag Successfully deleted');
    }

    public function status($id)
    {
        $tagname = TagName::findOrFail($id);
        if ($tagname->status == 'inactive') {
            $newStatus = 'active';
        } else {
            $newStatus = 'inactive';
        }

        $tagname->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('message', 'Status changed successfully');
    }
}
