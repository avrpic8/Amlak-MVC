<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use App\Http\Models\Post;
use App\Http\Requests\admin\PostRequest;
use App\Http\Services\ImageUpload;
use System\Auth\Auth;

class PostController extends Controller {

    public function index()
    {
        $posts = Post::all();
        view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        view('admin.post.create', compact('categories'));
    }

    public function store()
    {
        $request = new PostRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $path = 'images/posts/' . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10,99);
        $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        Post::create($inputs);
        return redirect('admin/post');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        view('admin.post.edit', compact('post','categories'));
    }

    public function update($id)
    {
        $request = new PostRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $file = $request->file('image');
        if(!empty($file['tmp_name']))
        {
            $path = 'images/posts/' . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10,99);
            $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        }
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        Post::update($inputs);
        return redirect('admin/post');
    }

    public function destroy($id)
    {
        Post::delete($id);
        back();
    }

}