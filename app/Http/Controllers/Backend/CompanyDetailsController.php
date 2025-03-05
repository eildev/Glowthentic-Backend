<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyDetailsController extends Controller
{
    public function index()
    {
        return view('backend.company-details.insert');
    }

    public function store(Request $request)
    {

        $request->validate([
            'company_name' => 'required|max:200',
            'manager_name' => 'required|max:200',
            'address' => 'required|max:200',
            'email' => 'required|max:200',
            'phone' => 'required|max:16',
        ]);
        CompanyDetails::insert([
            'company_name' => $request->company_name,
            'manager_name' => $request->manager_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Company Details Successfully Saved');
    }

    public function view()
    {
        $allData = CompanyDetails::all();
        return view('backend.company-details.view', compact('allData'));
    }
    public function edit($id)
    {
        $data = CompanyDetails::findOrFail($id);
        return view('backend.company-details.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|max:200',
            'manager_name' => 'required|max:200',
            'address' => 'required|max:200',
            'email' => 'required|max:200',
            'phone' => 'required|max:16',
        ]);
        CompanyDetails::findOrFail($id)->update([
            'company_name' => $request->company_name,
            'manager_name' => $request->manager_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('company-details.view')->with('success', 'Company Details Successfully Updated');
    }
    public function delete($id)
    {
        CompanyDetails::findOrFail($id)->delete();
        return back()->with('success', 'Company Details successfully Deleted');
    }

    public function status($id)
    {
        $data = CompanyDetails::findOrFail($id);
        if ($data->status == 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }

        $data->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('success', 'Status Changed Successfully');
    }
}
