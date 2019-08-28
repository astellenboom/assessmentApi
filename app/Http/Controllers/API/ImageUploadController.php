<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imageupload;


/*

* Controller method to upload images to the database 
* @param Request $request
*/


class ImageUploadController extends Controller
{
    public function imagePost(Request $request){

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "id" => "required"
        ]);
        // echo $request;

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
	   	$request->image->move(public_path('images'), $imageName);
        $path = public_path('images').'/'.$imageName;
        $name = $request->image->getClientOriginalName();
        
        $imageupload = new Imageupload;
        
        $imageupload->image=$imageName;
        $imageupload->path=$path;
        $imageupload->image_name=$name;
        $imageupload->user_id =$request->id;
        $imageupload->save();
        
    	return response()->json(['success'=>'Image has been Uploaded successfully.','path' => $path, 'name' => $name]); 
    
    }



/*

* Controller method to get all images from the database 
* @param Request $request
*/
public function getAllImages(Request $request){

   	$this->validate($request, [
          	'id' => 'required',	
        ]);
	
	$image  = new Imageupload();
   	$images = $image->select('path','image_name')->where("user_id", $request->id )->get();
   	$img_arr = [];

   	foreach($images as $img){
		$img_arr [] = ['path' => $img->path, 'name' => $img->image_name];   			

   	}

   if(empty($img_arr)){

   		return response()->json(['unsuccessful'=>'No images available']); 
   
   } else {
   		
   		return response()->json($img_arr);
   
   }		

}


/*
* Controller method to get images by search 
* @param Request $request
*
*/

   public function searchImages(Request $request){

   	$this->validate($request, [
          	'name' => 'required',	
        ]);
	
	$image  = new Imageupload();
   	$images = $image->select('path','image_name')->where("image_name", "LIKE", "%".$request->name."%" )->get();
   	
   	$img_arr = [];

   	foreach($images as $img){
		
		$img_arr [] = ['path' => $img->path, 'name' => $img->image_name];   			
	
	}

	if(empty($img_arr)){

		return response()->json(['unsuccessful'=>'No images with that name']); 

	} else {
		
		return response()->json($img_arr);
	
	}

   }


}
