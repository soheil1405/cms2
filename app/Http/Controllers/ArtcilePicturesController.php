<?php

namespace App\Http\Controllers;

use App\Models\Admin\ArtcilePictures;
use Illuminate\Http\Request as HttpRequest;

class ArtcilePicturesController extends Controller
{

    public function index()
    {

    }

    public function store(HttpRequest $request)
    {

        if (is_array($request->images)) {
            foreach ($request->images as $image) {

                $fileNamePrimaryImage = generateFileName($image->getClientOriginalName());

                $final = $image->move(public_path(env('ARTICLE_IMAGES_UPLOAD_PATH')), $fileNamePrimaryImage);

                ArtcilePictures::create([

                    'image' => $fileNamePrimaryImage,

                ]);

            }
        } else {

            $fileNamePrimaryImage = generateFileName($request->images->getClientOriginalName());

            $final = $request->images->move(public_path(env('ARTICLE_IMAGES_UPLOAD_PATH')), $fileNamePrimaryImage);

            ArtcilePictures::create([

                'image' => $fileNamePrimaryImage,

            ]);

        }

        return redirect()->back();

    }

}
