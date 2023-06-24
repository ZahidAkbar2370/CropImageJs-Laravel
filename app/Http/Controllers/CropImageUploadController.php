<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Models\Image;
 
class CropImageUploadController extends Controller
{
    public function index()
    {
     return view('image-crop');
    }
 
    public function store(Request $request)
    {
        $folderPath = public_path('upload/');
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
 
        file_put_contents($imageFullPath, $image_base64);
 
         $saveFile = new Image;
         $saveFile->title = $imageName;
         $saveFile->save();
    
        return response()->json(['success'=>'Crop Image Saved/Uploaded Successfully']);
    }
}