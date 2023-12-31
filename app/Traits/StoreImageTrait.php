<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 
trait  StoreImageTrait{
public function storeTraitUpload($request,$fieldName,$folderName){
    if($request->hasFile($fieldName)){
        $file = $request->$fieldName;
        $filenameOrigin =$file->getClientOriginalName();
        $filename = Str::random(length:20) . '.' . $file->getClientOriginalExtension();
    $path = $request->file($fieldName)->storeAs('public/'. $folderName . '/' . auth()->id(),$filename);
    $dataImageUpload = [
    'file_name' => $filenameOrigin,
    'file_path' =>Storage::url($path)
    ];
    return $dataImageUpload;
    }
    return null;
   

}


//upload detail image
public function storeTraitUploadDetail($file,$folderName){
 
        
        $filenameOrigin =$file->getClientOriginalName();
        $filename = Str::random(length:20) . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('public/'. $folderName . '/' . auth()->id(),$filename);
    $dataImageUpload = [
    'file_name' => $filenameOrigin,
    'file_path' =>Storage::url($path)
    ];
    return $dataImageUpload;
    

   

}
}