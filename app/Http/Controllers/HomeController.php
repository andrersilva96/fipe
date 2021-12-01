<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Services\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function home(Request $request)
    {
        if ($request->isMethod('post')) {
            Auth::user()->tips()->create($request->all());
            return redirect()->route('home');
        }

        return view('home', ['tips' => Helper::paginate(Tip::orderByDesc('id'))]);
    }
}
