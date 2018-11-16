<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Follow;
use App\Helper\CacheHelper;
use App\Helper\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $user     = Auth::user();
        $articles = $user->articles->keyBy('id');
        $comments = $user->comments()->paginate(10);
        $marks    = $user->marks->keyBy('id');

        return view('web.user.index', ['articles' => $articles, 'comments' => $comments, 'marks' => $marks, 'user' => $user]);
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('web.user.show', ['user' => $user]);
    }

    public function edit($user_id)
    {
        $user   = User::findOrFail($user_id);

        return view('web.user.edit', ['user' => $user]);
    }

    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'name'              =>  'required|unique:users,name,'.$user_id,
            'province'          =>  'string',
            'city'              =>  'string',
            'district'          =>  'string',
            'address'           =>  'string|nullable',
            'self_introduction' =>  'string|max:100|nullable'
        ]);

        $user   = User::findOrFail($user_id);
        $user->update([
            'name'              => $request->input('name'),
            'province'          => $request->input('province'),
            'city'              => $request->input('city'),
            'district'          => $request->input('district'),
            'address'           => $request->input('address'),
            'self_introduction' => $request->input('self_introduction')
        ]);

        return redirect('user')->with('success', '修改成功');
    }

    public function mind($user_id)
    {
        $user      = User::findOrFail($user_id);
        if (!empty(Auth::user()->follows->where('user_id', $user_id)->toArray)) {
            return redirect()->back()->withErrors('你已关注此作者');
        } else {
            Follow::create([
                'mind_id' => $user->id,
                'user_id' => Auth::user()->id
            ]);
            $user->increment('fans');
            Auth::user()->increment('follow');

            return redirect('user/'.$user->id)->with('success', '关注成功');
        }
    }

    public function myArticle()
    {
        $user     = Auth::user();
        $categories = CacheHelper::find('category');
        $articles = $user->articles()->paginate(10);

        return view('web.user.myArticle', ['articles' => $articles, 'categories' => $categories]);
    }

    public function upload(Request $request, $user_id)
    {
        $this->validate($request, [
            'source'    =>  'image'
        ]);
        $user = User::findOrFail($user_id);
        $file = $request->file('source');
        if (!empty($file)) {
            if ($file->isValid()) {
                $path = ImageHelper::saveImage($file, 200, 200);//写死的图片的大小，后期套用jQuery的插件进行修改。
                $user->update([
                    'avatar'    =>  !empty($path) ? $path : $user->getOriginal('avatar')
                ]);
                return redirect('user');
            }
        }

        return view('web.user.upload', ['user' => $user]);
    }

}
