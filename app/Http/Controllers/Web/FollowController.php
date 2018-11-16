<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Follow;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $follows    = Follow::with('user')->where('user_id', Auth::user()->id)->orderBy('id', 'ASC')->paginate(20);

        return view('web.follow.index', ['follows' => $follows]);
    }

    public function deleted($follow_id)
    {
        $follow = Follow::findOrFail($follow_id);
        $follow->delete();
        User::where('id', $follow->mind_id)->decrement('fans');
        Auth::user()->decrement('follow');

        return redirect('follow')->with('success', '删除成功');
    }
}
