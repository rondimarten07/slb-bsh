<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FileUpload;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', ['data' => User::where('role', '!=', User::ROLE_SUPERADMIN)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', // Ensure email uniqueness
            'password' => 'required',
            'role' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // Validate and restrict image uploads
        ]);

        $data = new User();

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = Hash::make($request->input('password'));
        $data->position = $request->input('position');
        $data->role = $request->input('role');

       // Save the user data to the database
        if (!$data->save()) {
            return back()->withInput()->withErrors(['message' => 'User creation failed.']);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = date("YmdHis") . rand(0,99) . '.' . $file->getClientOriginalExtension();
            
            // Create and save the image record
            $data->images()->create([
                'originalname' => $file->getClientOriginalName(),
                'mimetype' => $file->getMimeType(),
                'encoding' => null,
                'path' => '/uploads',
                'destination' => '/uploads/' . $filename,
                'size' => $file->getSize(),
                'aux' => null,
                'uploader_id' => $data->id,
                'object_id' => $data->id
            ]);

            // Move the uploaded image to the desired location
            $file->move('uploads', $filename);
        }

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.user.detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.user.edit', ['data' => User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::find($id);

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->position = $request->input('position');


        if ($request->hasFile('image')) {

            // Validate and save the new image
            $file = $request->file('image');
            
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif', // Adjust validation rules as needed
            ]);
    
            // Delete the old image file
            if ($data->images->isNotEmpty()) {
                $oldImage = $data->images->first();
                Storage::delete($oldImage->destination);
                $oldImage->delete(); // Delete the old image record
            }
    
            // Save the new image record
            $filename = date("YmdHis") . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $data->images()->create([
                'originalname' => $file->getClientOriginalName(),
                'mimetype' => $file->getMimeType(),
                'encoding' => null,
                'path' => '/uploads',
                'destination' => '/uploads/' . $filename,
                'size' => $file->getSize(),
                'aux' => null,
                'uploader_id' => $data->id,
                'object_id' => $data->id,
            ]);
    
            // Move the uploaded image to the desired location
            $file->move('uploads', $filename);
        }

        if($data->save()){
            return redirect()->route('user.index');
        } else {
            return back()->withInput(Input::all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('user.index');
    }
}
