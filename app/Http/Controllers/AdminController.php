<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $data = ArticleCategory::all();
        return view('dashboard', compact('data'));
    }
}
