<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        return view('backend.report-and-issue.index', compact('reports'));
    }

    public function insert()
    {
        return view('backend.report-and-issue.insert');
    }

    public function store(Request $request, ImageOptimizerService $imageService)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:width=200,height=200',
                'source' => 'nullable|in:website,mail,whatsapp,facebook,others,admin',
                'source_reference' => 'nullable|string|max:255',
                'status' => 'nullable|in:pending,in-progress,solve,issue,other',
                'note' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Failed to add report due to invalid input.');
            }

            // Create a new Report instance
            $report = new Report;
            $report->title = $request->title;
            $report->description = $request->description;
            $report->source = $request->source ?? 'website'; // Default to 'website'
            $report->source_reference = $request->source_reference;
            $report->status = $request->status ?? 'pending'; // Default to 'pending'
            $report->note = $request->note;

            // Handle image upload
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                $destinationPath = public_path('uploads/report');
                $imageName = $imageService->resizeAndOptimize($request->file('attachment'), $destinationPath);
                $report->attachment = 'uploads/report/' . $imageName;
            }

            // Save the Report record
            $report->save();

            return redirect()->route('report')->with('success', 'Report added successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error saving report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save report: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('backend.report-and-issue.edit', compact('report'));
    }
    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {
        try {
            // Find the report
            $report = Report::findOrFail($id);

            // Validate the request
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:width=200,height=200',
                'source' => 'nullable|in:website,mail,whatsapp,facebook,others,admin',
                'source_reference' => 'nullable|string|max:255',
                'status' => 'nullable|in:pending,in-progress,solve,issue,other',
                'note' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Failed to update report due to invalid input.');
            }

            // Handle image upload
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                // Delete old image if it exists
                if ($report->attachment && file_exists(public_path($report->attachment))) {
                    unlink(public_path($report->attachment));
                }
                // Save new image
                $destinationPath = public_path('uploads/report');
                $imageName = $imageService->resizeAndOptimize($request->file('attachment'), $destinationPath);
                $report->attachment = 'uploads/report/' . $imageName;
            }

            // Update report
            $report->update([
                'title' => $request->title,
                'description' => $request->description,
                'source' => $request->source ?? 'website', // Default to 'website'
                'source_reference' => $request->source_reference,
                'status' => $request->status ?? 'pending', // Default to 'pending'
                'note' => $request->note,
            ]);

            return redirect()->route('report')->with('success', 'Report updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update report: ' . $e->getMessage());
        }
    }


    public function status(Request $request, $id)
    {
        // Find the report
        $report = Report::findOrFail($id);

        // Validate the status
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,in-progress,solve,issue,other'
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Invalid status selected.');
        }

        // Update the status
        $report->status = $request->status;
        $report->save(); // Use save() instead of update() for single field updates

        return redirect()->back()->with('message', 'Status changed successfully');
    }

    public function viewDetails($id)
    {
        $report = Report::findOrFail($id);
        return view('backend.report-and-issue.view-details', compact('report'));
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);
        if ($report->attachment) {
            $imagePath = public_path($report->attachment);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $report->delete();
        return back()->with('success', 'Report Successfully deleted');
    }
}
