<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Mark;
use App\Models\Browse;
use App\Models\Article;
use App\Models\Comment;
use App\Helper\CacheHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $this->validate($request, [
            'title' => 'string'
        ]);
        $search = array_filter($request->only(['title']), function($var) {
            return !empty($var);
        });

        $articles = new Article();
        foreach ($search as $key => $value) {
            if (in_array($key, ['title'])) {
                $articles = $articles->where($key, 'LIKE', '%'.$value.'%');
            }
        }
        $articles = $articles->where('is_check', 1)->orderBy('id', 'DESC')->paginate(10);
        $categories = CacheHelper::find('category');
        $popular_article = Article::where('is_check', 1)->orderBy('comments', 'desc')->limit(10)->get();

        return view('web.article.index', ['articles' => $articles, 'popular_article' => $popular_article, 'categories' => $categories, 'search' => $search]);
    }

    public function show($article_id)
    {
        $article  = Article::with('comment', 'marks')->findOrFail($article_id);
        $categories = CacheHelper::find('category');
        $article->increment('browses');
        if (!empty(Auth::user())) {
            $is_collection = $article->marks->where('user_id', Auth::user()->id)->where('article_id', $article_id)->toArray();

            Browse::create([
                'article_id' => $article->id,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

            return view('web.article.show', ['article' => $article, 'categories' => $categories, 'is_collection' => $is_collection]);
        }

        return view('web.article.show', ['article' => $article, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = CacheHelper::find('category');
        return view('web.article.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|min:3|string',
            'content'       => 'required|string',
            'category_id'   => 'required|integer|exists:categories,id'
        ]);

        Article::create([
            'title'         =>  $request->input('title'),
            'content'       =>  $request->input('content'),
            'category_id'   =>  $request->input('category_id'),
            'user_id'       =>  $request->user()->id,
            'is_check'      =>  0
        ]);

        return redirect('article')->with('success', '创建成功,等待审核');
    }

    public function edit($article_id)
    {
        $article    = Article::findOrFail($article_id);
        if ($article->is_check == 0) {
            return redirect()->back()->withErrors('该文章暂时无法修改');
        }
        $categories = CacheHelper::find('category');

        return view('web.article.edit', ['article' => $article, 'categories' => $categories]);
    }

    public function update(Request $request, $article_id)
    {
        $this->validate($request, [
            'title'         => 'required|min:3',
            'content'       => 'required',
            'category_id'   => 'required|integer|exists:categories,id'
        ]);

        $article = Article::findOrFail($article_id);
        if ($article->user_id == $request->user()->id) {
            $article->update([
                'title'         => $request->input('title'),
                'content'       => $request->input('content'),
                'category_id'   => $request->input('category_id'),
            ]);

            return redirect('article')->with('success', '修改成功');
        } else {
            return redirect()->back()->withErrors('无权限修改');
        }
    }

    public function deleted($article_id)
    {
        $article = Article::findOrFail($article_id);
        if (Auth::user()->id == $article->user->id && $article->is_check == 1) {
            $article->delete();
            Comment::where('article_id', $article_id)->delete();
            Browse::where('article_id', $article_id)->delete();
            Mark::where('article_id', $article_id)->delete();
            return redirect('article')->with('success', '删除成功');
        } else {
            return redirect()->back()->withErrors('权限不足');
        }

    }

    public function mark($article_id)
    {
        $article = Article::with('marks')->findOrFail($article_id);

        if (empty($article) || $article->is_check == 0) {
            return redirect()->back()->withErrors('该文章暂时无法收藏');
        }
        if (empty($article->marks->where('user_id', Auth::user()->id)->where('article_id', $article_id)->toArray())) {
            Mark::create([
                'user_id'    => Auth::user()->id,
                'article_id' => $article_id,
                'created_at' => Carbon::now(),
            ]);
            $article->increment('collections');
            return redirect('article/'.$article->id)->with('success', '收藏成功');
        } else {
            return redirect()->back()->withErrors('该文章已收藏');
        }
    }
}
