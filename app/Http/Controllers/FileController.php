<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($fileName)
    {
        $imageFile = storage_path('app/'.str_replace("-","/",$fileName));
        if(!is_file($imageFile)){
            abort(404);
        }

        header('Content-Type: '. mime_content_type( $imageFile ));

        echo file_get_contents($imageFile);

    }

}
