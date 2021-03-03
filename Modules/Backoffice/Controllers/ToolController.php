<?php

namespace Backoffice\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backoffice.tools.index');
    }
}