<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Conversions\ImageGenerators\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        $filename = time() . '_' . random_int(100000000, 999999999) . '.' . $request->image->extension();

        $request->image->move(public_path('images/temp'), $filename);

        return ApiResponse::success([
            "image" => $filename], 200, "you image is upload",);

    }
    //
    public function uploadImage64(Request $request) {
        $filename = time() . '_' . random_int(100000000, 999999999) . '.' . 'png';
        $image = $request->image;
        $image = str_replace('data:image/png;base64,','',$image);
        $image = str_replace(' ','+',$image);
        Storage::disk('public')->put($filename,base64_decode($image));


        return ApiResponse::success($filename,200);

    }


}
