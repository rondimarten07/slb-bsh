<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.post.index', ['data' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Post();

        $data->title = $request->get('title');
        $data->content = $request->get('content');
        $data->meta = $request->get('meta');
        
        // Save the user data to the database
        if (!$data->save()) {
            return back()->withInput()->withErrors(['message' => 'Post creation failed.']);
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

        return redirect()->route('post.index')->with('success', 'Post created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.post.detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.post.edit', ['data' => Post::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Post::find($id);

        $data->title = $request->get('title');
        $data->content = $request->get('content');
        $data->meta = $request->get('meta');

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
            return redirect()->route('post.index');
        } else {
            return back()->withInput(Input::all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect()->route('post.index');
    }
}
