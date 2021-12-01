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

        $tips = Tip::orderByDesc('id');

        if ($data = $request->except('_token')) {
            if ($request->input('type')) $tips->where('type', $request->input('type'));
            if ($request->input('brand')) $tips->where('brand', $request->input('brand'));
            if ($request->input('fipe')) $tips->where('fipe', $request->input('fipe'));
            if ($request->input('year')) $tips->where('year', $request->input('year'));
        }

        return view('home', ['tips' => Helper::paginate($tips)]);
    }
}
