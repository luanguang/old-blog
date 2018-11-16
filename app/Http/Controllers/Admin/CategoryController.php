<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Helper\CacheHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CacheHelper::find('category');

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function show($category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('admin.category.show', ['category' => $category]);
    }

    public function create()
    {
        return view('admin.category.show');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string'
        ]);

        Category::create([
            'name'  =>  $request->input('name')
        ]);

        CacheHelper::flush('category');

        return redirect('admin/category')->with('success', '创建成功');
    }

    public function update(Request $request, $category_id)
    {
        $this->validate($request, [
            'name'  =>  'required|string'
        ]);
        $category = Category::findOrFail($category_id);
        $category->update([
            'name'  =>  $request->input('name')
        ]);
        CacheHelper::flush('category');

        return redirect('admin/category')->with('success', '修改成功');
    }

    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->delete();
        Article::where('category_id', $category_id)->update(['category_id' => 0]);
        CacheHelper::flush('category');

        return response()->json(['code' => 200]);
    }
}