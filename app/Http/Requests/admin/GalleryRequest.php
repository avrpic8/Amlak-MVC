<?php

namespace App\Http\Requests\admin;

use System\Request\Request;

class GalleryRequest extends Request
{
    public function rules(){
        return [
            'image' => 'required|file|mimes:jpeg,jpg,png,gif'
        ];
    }
}