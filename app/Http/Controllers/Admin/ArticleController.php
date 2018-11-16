<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Mark;
use App\Models\Browse;
use App\Models\Article;
use App\Models\Comment;
use App\Helper\CacheHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'category_id'   =>  'nullable|integer|exists:categories,id',
            'title'         =>  'nullable|string',
            'is_check'      =>  'nullable|boolean',
//            'created_time'  =>  'string',
        ]);

        $search = array_filter($request->only(['category_id', 'title', 'is_check']), function ($var) {
            return !empty($var);
        });

        $articles = new Article();
        foreach ($search as $key => $value) {
            if (in_array($key, ['category_id', 'is_check'])) {
                $articles = $articles->where($key, $value);
            } elseif (in_array($key, ['title'])) {
                $articles = $articles->where($key, 'LIKE', '%'.$value.'%');
            }
        }
        $categories = CacheHelper::find('category');
        $articles = $articles->orderBy('id', 'DESC')->paginate(20);

        return view('admin.article.index', ['articles' => $articles, 'search' => $search, 'categories' => $categories]);
    }

    public function show($article_id)
    {
        $article = Article::findOrFail($article_id);
        $categories = CacheHelper::find('category');

        return view('admin.article.show', ['article' => $article, 'categories' => $categories]);
    }

    public function update(Request $request, $article_id)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'content'       =>  'required|string',
            'is_check'      =>  'nullable|boolean',
            'category_id'   =>  'required|integer|min:0',
        ]);

        $article = Article::findOrFail($article_id);

        $article->update([
            'title'         =>  $request->input('title'),
            'content'       =>  $request->input('content'),
            'is_check'      =>  !empty($request->input('is_check')) ? $request->input('is_check') : 0,
            'category_id'   =>  $request->input('category_id'),
        ]);

        return redirect('admin/article')->with('success', '修改成功');
    }

    public function destroy($article_id)
    {
        $article = Article::findOrFail($article_id);
        Browse::where('article_id', $article_id)->delete();
        Comment::where('article_id', $article_id)->delete();
        Mark::where('article_id', $article_id)->delete();
        $article->delete();

        return response()->json(['code' => 200]);
    }
}