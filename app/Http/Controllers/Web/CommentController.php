<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $article_id)
    {
        $this->validate($request, [
            'content'       =>  'required|string'
        ]);
        $article    = Article::findOrFail($article_id);
        if (empty($article) || $article->is_check == 0) {
            return redirect()->back()->withErrors('该文章暂时无法评论');
        }
        Comment::create([
            'content'    =>  $request->input('content'),
            'user_id'    =>  $request->user()->id,
            'article_id' =>  $article_id,
            'created_at' =>  Carbon::now(),
        ]);

        $article->increment('comments');

        return redirect('article/'.$article->id);
    }

    public function deleted($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        if ($comment->user_id == Auth::user()->id || Auth::user()->id == $comment->article->user_id) {
            $comment->article->decrement('comments');
            $comment->delete();
            return redirect()->back()->with('success', '删除成功');
        } else {
            return redirect()->back()->withErrors('你的权限不够');
        }
    }
}
