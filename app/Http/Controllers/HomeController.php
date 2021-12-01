<?php

namespace App\Http\Controllers;

use App\Models\Tip;
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

        $tips = Tip::paginate(25 ?? $request->input('perPage'));
        return view('home', ['tips' => $tips]);
    }
}
