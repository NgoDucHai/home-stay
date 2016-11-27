<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function create()
    {
        return view('add');
    }
    public function store(Request $request)
    {
        $images = $request->allFiles();
        $listImageName = [];
        foreach ($images['file'] as $i => $image){
            $imageName = time().$image->getClientOriginalName();
            $image->move(public_path('upload'),$imageName);
            $listImageName[$i] =$imageName;
        }

        return response()->json(['images'=>$listImageName]);
    }
}