<?php

namespace App\Http\Controllers\Web;

use App\Helper\CacheHelper;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = CacheHelper::find('category');

        return view('web.category.index', ['categories' => $categories]);
    }
}
