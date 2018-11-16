<?php

namespace App\Http\Controllers\Web;

use App\Models\Browse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
   {
       $browses = Browse::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(20);

       return view('web.browse.index', ['browses' => $browses]);
   }

}
