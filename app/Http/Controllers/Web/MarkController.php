<?php

namespace App\Http\Controllers\Web;

use App\Models\Mark;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('web.mark.index');
    }

    public function deleted($mark_id)
    {
        $mark   = Mark::findOrFail($mark_id);
        if (Auth::user()->id == $mark->user_id) {
            $mark->delete();
            Article::where('id', $mark->article_id)->decrement('collections');
        }

        return redirect('mark')->with('success', '删除成功');
    }
}
