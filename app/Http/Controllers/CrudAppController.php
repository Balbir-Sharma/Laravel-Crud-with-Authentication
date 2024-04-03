<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CrudApp;
use Session;
use File; // Import File facade here
use Illuminate\Support\Facades\File as FacadesFile; // Or use this alias

class CrudAppController extends Controller
{
    public function all_records()
    {
        $all_records = CrudApp::latest()->simplePaginate(5);
        return view('all_records',compact('all_records'));
    }

    public function add_new_record()
    {
        return view('add_new_record');
    }

    public function store_new_record(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|email|max:50',
            'image' => 'required|mimes:jpg,jpeg,png,bmp',
            'phone' => 'required',
            'services' => 'required|array', // Change to array validation
            'services.*' => 'string|distinct', // Ensure each service is unique
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'branch' => 'required',
        ]);
    
        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/profile', $imageName);
        }
    
        // Serialize services array to store it in the database
        $services = implode(', ', $request->services);
    
        CrudApp::create([
            'image' => $imageName,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'services' => $services,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'branch' => $request->branch,
        ]);
    
        return redirect()->back();
    }
    
    public function edit_record($id)
    {
        $record = CrudApp::findOrFail($id);
        return view('edit_record',compact('record'));
    }

    public function update_record(Request $request, $id)
    {
        $record = CrudApp::findOrFail($id);
    
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|email|max:50',
            'phone' => 'required',
            'services' => 'required|array', // Change to array validation
            'services.*' => 'string', // Ensure each service is a string
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'branch' => 'required',
        ]);
    
        $imageName = '';
        $deleteOldImg = 'images/profile/' . $record->image;
    
        if ($image = $request->file('image')) {
            if (file_exists($deleteOldImg)) {
                FacadesFile::delete($deleteOldImg); // Use the File facade directly
            }
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/profile', $imageName);
        } else {
            $imageName = $record->image;
        }
    
        // Serialize services array to store it in the database
        $services = implode(', ', $request->services);
    
        $record->update([
            'image' => $imageName,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'services' => $services,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'branch' => $request->branch,
        ]);
    
        return redirect()->back();
    }
    
    public function delete_record($id)
    {
        $record = CrudApp::find($id);
        $deleteImg =  'images/profile/'.$record->image;
        if (file_exists($deleteImg)) {
            FacadesFile::delete($deleteImg); // Use the File facade here
        }
        $record->delete();
        return redirect()->back();
    }
}
