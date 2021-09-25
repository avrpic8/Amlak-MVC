<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Ads;
use App\Http\Models\Category;
use App\Http\Models\Post;
use App\Http\Models\Gallery;
use App\Http\Requests\admin\AdsRequest;
use App\Http\Requests\admin\GalleryRequest;
use App\Http\Services\ImageUpload;
use System\Auth\Auth;

class AdsController extends Controller
{
    public function index()
    {
        $ads = Ads::all();
        view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        $categories = Category::all();
        view('admin.ads.create', compact('categories'));
    }

    public function store()
    {
        $request = new AdsRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $inputs['view'] = 0;
        $path = 'images/ads/' . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10,99);
        $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 532);
        Ads::create($inputs);
        return redirect("admin/ads");
    }

    public function edit($id)
    {
        $advertise = Ads::find($id);
        $categories = Category::all();
        view('admin.ads.edit', compact('advertise', 'categories'));
    }

    public function update($id)
    {
        $request = new AdsRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $file = $request->file('image');
        if(!empty($file['tmp_name']))
        {
            $path = 'images/ads/' . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10,99);
            $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 532);
        }
        Ads::update($inputs);
        return redirect("admin/ads");
    }

    public function destroy($id)
    {
        Ads::delete($id);
        return back();
    }

}