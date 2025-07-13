<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index', ['data' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Product();

        $data->name = $request->get('name');
        $data->description = $request->get('description');
        $data->itinerary = $request->get('itinerary');
        $data->term_condition = $request->get('term_condition');
        $data->price = $request->get('price');
        $data->min_guest = $request->get('min_guest');
        $data->duration = $request->get('duration');
        $data->type = $request->get('type');
        $data->meta = $request->get('meta');
        $data->location = $request->get('location');
        
        // Save the product data to the database
        if (!$data->save()) {
            return back()->withInput()->withErrors(['message' => 'Product creation failed.']);
        }

        if($request->hasFile('images')){
            if($data->images->isNotEmpty()){
                foreach($data->images as $image){
                    Storage::delete($image->destination);
                    $image->delete();
                }
            }
            
            $files = $request->file('images');

            foreach($files as $i => $file){
                $filename = date("YmdHis") . rand(0,999) . '.' . $file->getClientOriginalExtension();
                
                // Create and save the image record
                $data->images()->create([
                    'originalname' => $file->getClientOriginalName(),
                    'alt_text' => $request->input('alt_texts')[$i] ,
                    'mimetype' => $file->getMimeType(),
                    'encoding' => null,
                    'path' => '/uploads',
                    'destination' => '/uploads/' . $filename,
                    'size' => $file->getSize(),
                    'aux' => $i,
                    'uploader_id' => Auth::user()->id,
                    'object_id' => $data->id
                ]);

                // Move the uploaded image to the desired location
                $file->move('uploads', $filename);
            }
        }

        return redirect()->route('product.index')->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.product.detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.product.edit', ['data' => Product::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Product::find($id);

        $data->name = $request->get('name');
        $data->description = $request->get('description');
        $data->itinerary = $request->get('itinerary');
        $data->term_condition = $request->get('term_condition');
        $data->price = $request->get('price');
        $data->min_guest = $request->get('min_guest');
        $data->duration = $request->get('duration');
        $data->type = $request->get('type');
        $data->meta = $request->get('meta');
        $data->location = $request->get('location');

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
                'object_id' => $data->id,
            ]);
    
            // Move the uploaded image to the desired location
            $file->move('uploads', $filename);
        }

        if($data->save()){
            return redirect()->route('product.index');
        } else {
            return back()->withInput(Input::all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('product.index');
    }
}
