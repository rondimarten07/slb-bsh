<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\FileUpload;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('file')){
            return back()->withInput();
        }

        $file = $request->file('file');
        $filename = date("YmdHis") . rand(0,99) . '.' . $file->getClientOriginalExtension();

        FileUpload::create([
            'originalname' => $file->getClientOriginalName(),
            'alt_text' => $request->input('alt_text'),
            'mimetype' => $file->getMimeType(),
            'encoding' => null, 
            'path' => '/uploads',
            'destination' => '/uploads/' . $filename,
            'size' => $file->getSize(),
            'aux' => null,
            'uploader_id' => Auth::user()->id,
            'object_id' => $request->input('object_id'),
            'object_type' => $request->input('object_type'),
        ]);


        $file->move('uploads', $filename);

        if(isset($request->current_url)){
            return redirect($request->current_url);
        } else {
            return back();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = FileUpload::find($id);
        Storage::delete($data->destination);
        $data->delete();
        return back()->withInput();
    }
}
