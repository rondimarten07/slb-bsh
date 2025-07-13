<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Configuration;
use App\Models\FileUpload;

class ConfigurationController extends Controller
{
    public function index(){
        $data = Configuration::all();
        return view('admin.config.site', [
            'whatsapp' => $data->where('name', Configuration::WHATSAPP)->first()->value,
            'headscript' => $data->where('name', Configuration::HEADSCRIPT)->first()->value,
            'bodyscript' => $data->where('name', Configuration::BODYSCRIPT)->first()->value,
        ]);
    }

    public function homepage(){
        return view('admin.config.homepage', [
            "partners" => FileUpload::where('object_type', FileUpload::TYPE_PARTNER)->get(),
            "guestdocs" => FileUpload::where('object_type', FileUpload::TYPE_GUEST_DOCUMENTATION)->get(),

            "HomeSection1Title" => Configuration::getHomeSectionTitle(1),
            "HomeSection2Title" => Configuration::getHomeSectionTitle(2),
            "HomeSection3Title" => Configuration::getHomeSectionTitle(3),
            "HomeSection4Title" => Configuration::getHomeSectionTitle(4),
            "HomeSection5Title" => Configuration::getHomeSectionTitle(5),
            "HomeSection1Content" => Configuration::getHomeSectionContent(1),
            "HomeSection5Content" => Configuration::getHomeSectionContent(5),

            "AboutSection1Title" => Configuration::getAboutSectionTitle(1),
            "AboutSection1Content" => Configuration::getAboutSectionContent(1),
            
            "WhatsAppSection" => Configuration::getWhatsAppSection(),
            // "HomeSection5Content" => Configuration::getHomeSectionContent(5),
        ]);
    }

    public function update(Request $request){
        $data = Configuration::all();

        foreach($data as $d){
            switch($d->name){
                case Configuration::WHATSAPP    : $d->value = $request->whatsapp; break;
                case Configuration::HEADSCRIPT  : $d->value = $request->headscript; break;
                case Configuration::BODYSCRIPT  : $d->value = $request->bodyscript; break;
                default: break;
            }
            $d->save();
        }

        if(isset($request->current_url)){
            return redirect($request->current_url);
        } else {
            return back();
        }
    }

    public function updateHomeSection(Request $request){
        $data = Configuration::all();

        foreach($data as $d){
            switch($d->name){
                case Configuration::HOME_SECTION_1_TITLE    : $d->value = $request->HomeSection1Title; break;
                case Configuration::HOME_SECTION_2_TITLE    : $d->value = $request->HomeSection2Title; break;
                case Configuration::HOME_SECTION_3_TITLE    : $d->value = $request->HomeSection3Title; break;
                case Configuration::HOME_SECTION_4_TITLE    : $d->value = $request->HomeSection4Title; break;
                case Configuration::HOME_SECTION_5_TITLE    : $d->value = $request->HomeSection5Title; break;

                case Configuration::HOME_SECTION_1_CONTENT  : $d->value = $request->HomeSection1Content; break;
                case Configuration::HOME_SECTION_5_CONTENT  : $d->value = $request->HomeSection5Content; break;
                
                case Configuration::WHATSAPP_SECTION        : $d->value = $request->WhatsAppSection; break;
                
                case Configuration::ABOUT_SECTION_1_TITLE   : $d->value = $request->AboutSection1Title; break;
                case Configuration::ABOUT_SECTION_1_CONTENT : $d->value = $request->AboutSection1Content; break;
                default: break;
            }
            $d->save();
        }

        // Home Section Image
        if ($request->hasFile('HomeSection1Image')) {
            // Validate and save the new image
            $file = $request->file('HomeSection1Image');
            
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif', // Adjust validation rules as needed
            ]);
    
            // Delete the old image file
            $oldImage = FileUpload::where('object_type', FileUpload::TYPE_HOME_SECTION_1)->first();
            Storage::delete($oldImage->destination);
            $oldImage->delete(); // Delete the old image record
    
            // Save the new image record
            $filename = date("YmdHis") . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            FileUpload::create([
                'originalname' => $file->getClientOriginalName(),
                'mimetype' => $file->getMimeType(),
                'encoding' => null,
                'path' => '/uploads',
                'destination' => '/uploads/' . $filename,
                'size' => $file->getSize(),
                'aux' => null,
                'uploader_id' => Auth::user()->id,
                'object_id' => null,
                'object_type' => FileUpload::TYPE_HOME_SECTION_1
            ]);
    
            // Move the uploaded image to the desired location
            $file->move('uploads', $filename);
        }

        if ($request->hasFile('HomeSection5Image')) {
            // Validate and save the new image
            $file = $request->file('HomeSection5Image');
            
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif', // Adjust validation rules as needed
            ]);
    
            // Delete the old image file
            $oldImage = FileUpload::where('object_type', FileUpload::TYPE_HOME_SECTION_5)->first();
            Storage::delete($oldImage->destination);
            $oldImage->delete(); // Delete the old image record
    
            // Save the new image record
            $filename = date("YmdHis") . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            FileUpload::create([
                'originalname' => $file->getClientOriginalName(),
                'mimetype' => $file->getMimeType(),
                'encoding' => null,
                'path' => '/uploads',
                'destination' => '/uploads/' . $filename,
                'size' => $file->getSize(),
                'aux' => null,
                'uploader_id' => Auth::user()->id,
                'object_id' => null,
                'object_type' => FileUpload::TYPE_HOME_SECTION_5
            ]);
    
            // Move the uploaded image to the desired location
            $file->move('uploads', $filename);
        }

        if(isset($request->current_url)){
            return redirect($request->current_url);
        } else {
            return back();
        }
    }

    
    function updatePartnerNGuestDoc(Request $request){
        if($request->hasFile('partner')){
            $file = $request->file('partner');
            $filename = date("YmdHis") . rand(0,999) . '.' . $file->getClientOriginalExtension();

            FileUpload::create([
                'originalname' => $file->getClientOriginalName(),
                'mimetype' => $file->getMimeType(),
                'encoding' => null,
                'path' => '/uploads',
                'destination' => '/uploads/' . $filename,
                'size' => $file->getSize(),
                'aux' => null,
                'uploader_id' => Auth::user()->id,
                'object_type' => FileUpload::TYPE_PARTNER
            ]);

            $file->move('uploads', $filename);
        }

        if($request->hasFile('guest_doc')){
            $file = $request->file('guest_doc');
            $filename = date("YmdHis") . rand(0,999) . '.' . $file->getClientOriginalExtension();

            FileUpload::create([
                'originalname' => $file->getClientOriginalName(),
                'mimetype' => $file->getMimeType(),
                'encoding' => null,
                'path' => '/uploads',
                'destination' => '/uploads/' . $filename,
                'size' => $file->getSize(),
                'aux' => null,
                'uploader_id' => Auth::user()->id,
                'object_type' => FileUpload::TYPE_GUEST_DOCUMENTATION
            ]);

            $file->move('uploads', $filename);
        }



        if(isset($request->current_url)){
            return redirect($request->current_url);
        } else {
            return back();
        }
    }
}
