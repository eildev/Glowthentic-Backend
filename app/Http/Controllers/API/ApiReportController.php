<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApiReportController extends Controller
{
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
}
