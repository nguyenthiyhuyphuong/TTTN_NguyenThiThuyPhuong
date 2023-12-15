<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $args = [
            ['status', '=', 1],
            ['parent_id', '=', 0]
        ];
        $list_category=Category::where($args)->orderBy('sort_order')->get();
        return view("frontend.home",compact('list_category'));
    }
}
