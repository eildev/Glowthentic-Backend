<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PopupMessage;
use Illuminate\Http\Request;

class PopupMessageController extends Controller
{
    // Popup Message index function
    public function index()
    {
        return view('backend.popupMessage.insert');
    }

    // Popup Message store function
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:200',
            'link' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->image);
        if ($request->image) {

            $imageName = rand() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/popupMessage/'), $imageName);
            $popupMessage = new PopupMessage;
            $popupMessage->title = $request->title;
            $popupMessage->description = $request->description;
            $popupMessage->link = $request->link;
            $popupMessage->image = $imageName;
            $popupMessage->save();
            return back()->with('success', 'Popup message Successfully Saved');
        }
    }

    // Popup Message View function
    public function view()
    {
        $popupMessages = PopupMessage::all();
        return view('backend.popupMessage.view', compact('popupMessages'));
    }


    // popup edit function 
    public function edit($id)
    {
        $popupMessage = PopupMessage::findOrFail($id);
        return view('backend.popupMessage.edit', compact('popupMessage'));
    }



    // Popup Message View function
    public function update(Request $request, $id)
    {
        if ($request->image) {
            $request->validate([
                'title' => 'required|max:100',
                'description' => 'required|max:200',
                'link' => 'required|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/popupMessage/'), $imageName);
            $popupMessage = PopupMessage::findOrFail($id);
            unlink(public_path('uploads/popupMessage/') . $popupMessage->image);
            $popupMessage->title = $request->title;
            $popupMessage->description = $request->description;
            $popupMessage->link = $request->link;
            $popupMessage->image = $imageName;
            $popupMessage->update();
            return redirect()->route('popupMessage.view')->with('success', 'Popup message Successfully Updated');
        } else {
            $request->validate([
                'title' => 'required|max:100',
                'description' => 'required|max:200',
                'link' => 'required|max:100',
            ]);
            $popupMessage = PopupMessage::findOrFail($id);
            $popupMessage->title = $request->title;
            $popupMessage->description = $request->description;
            $popupMessage->link = $request->link;
            $popupMessage->update();
            return redirect()->route('popupMessage.view')->with('success', 'Popup message Successfully Updated');
        }
    }



    public function delete($id)
    {
        $popupMessage = PopupMessage::findOrFail($id);
        unlink(public_path('uploads/popupMessage/') . $popupMessage->image);
        $popupMessage->delete();
        return back()->with('success', 'Popup Deleted Successfully');
    }
}
