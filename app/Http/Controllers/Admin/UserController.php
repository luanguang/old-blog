<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'name'          =>  'nullable|string',
//            'email'         =>  'nullable|email',
            'is_admin'      =>  'nullable|integer',
            'address'       =>  'nullable|string',
//            'created_time'  =>  'string',
        ]);

        $search = array_filter($request->only(['name', 'is_admin', 'address', 'eamil']), function ($var) {
            return !empty($var);
        });

        if (!empty($search['is_admin']) && $search['is_admin'] == 2) {
            $search['is_admin'] = 0;
        }

        $users = new User();
        foreach ($search as $key => $value) {
            if (in_array($key, ['name', 'address', 'email'])) {
                $users = $users->where($key, 'LIKE', '%'.$value.'%');
            } elseif (in_array($key, ['is_admin'])) {
                $users = $users->where($key, $value);
            }
        }

        $users = $users->paginate(20);
        if (isset($search['is_admin']) && $search['is_admin'] == 0) {
            $search['is_admin'] = 2;
        }

        return view('admin.user.index', ['users' => $users, 'search' => $search]);
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('admin.user.show', ['user' => $user]);
    }

    public function create()
    {
        return view('admin.user.show');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|string|unique:users',
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|string|min:6|confirmed',
            'is_admin'  =>  'nullable|boolean',
            'address'   =>  'nullable|string',
        ]);

        User::create([
            'name'      =>  $request->input('name'),
            'email'     =>  $request->input('email'),
            'password'  =>  bcrypt($request->input('password')),
            'is_admin'  =>  !empty($request->input('is_admin')) ? $request->input('is_admin') : 0,
            'address'   =>  $request->input('address'),
        ]);

        return redirect('admin/user')->with('success', '创建成功');
    }

    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'name'      =>  'required|string|unique:users,name,'.$user_id,
            'email'     =>  'required|email|unique:users,email,'.$user_id,
            'password'  =>  'required|string|min:6',
            'is_admin'  =>  'nullable|boolean',
            'address'   =>  'nullable|string'
        ]);

        $user = User::findOrFail($user_id);

        $user->update([
            'name'      =>  $request->input('name'),
            'email'     =>  $request->input('email'),
            'password'  =>  bcrypt($request->input('password')),
            'is_admin'  =>  !empty($request->input('is_admin')) ? $request->input('is_admin') : 0,
            'address'   =>  $request->input('address'),
        ]);

        return redirect('admin/user');
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return response()->json(['code' => 200]);
    }
}