<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Category;
use App\Http\Requests\admin\CategoryRequest;

class CategoryController extends AdminController {

    public function index()
    {
        $categories = Category::all();
        view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        view('admin.category.create', compact('categories'));
    }

    public function store()
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        if(empty($request->parent_id)) unset($inputs['parent_id']);
        Category::create($inputs);
        redirect('admin/category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        view('admin.category.edit', compact('category','categories'));
    }

    public function update($id)
    {
        $request = new CategoryRequest();
        $inputs  = $request->all();
        Category::update(array_merge($inputs, ['id' => $id]));
        redirect('admin/category');
    }

    public function destroy($id)
    {
        Category::delete($id);
        back();
    }
}