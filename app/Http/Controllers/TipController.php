<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index(Request $request, $tip)
    {
        if ($request->isMethod('POST')) {
            $tip->update($request->all());
            return redirect()->back();
        }
        return view('tip', ['tip' => $tip]);
    }

    public function delete($tip)
    {
        $tip->delete();
        return redirect()->route('home');
    }
}
