<?php

namespace App\Http\Requests\admin;

use System\Request\Request;

class PostRequest extends Request
{

    public function rules(){
        if(methodField() == 'put'){
            return [
                'title' => 'required|max:191',
                'body' => 'required',
                'cat_id' => 'required|exist:categories,id',
                'image' => 'file|mimes:jpeg,jpg,png,gif',
                'published_at' => 'required|date',
            ];
        }
        else{
            return [
                'title' => 'required|max:191',
                'body' => 'required',
                'cat_id' => 'required|exist:categories,id',
                'image' => 'required|file|mimes:jpeg,jpg,png,gif',
                'published_at' => 'required|date',
            ];
        }

    }
}