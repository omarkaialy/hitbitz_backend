<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

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
}
