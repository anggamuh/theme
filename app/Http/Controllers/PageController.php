<?php

namespace App\Http\Controllers;

use App\Models\ArticleShow;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        $data = ArticleShow::all();
        return view('guest.home', compact('data'));
    }

    public function author() {
        return view('guest.author');
    }

    public function category() {
        return view('guest.category');
    }

    public function business($slug) {
        $data = ArticleShow::where('slug', $slug)->first();
        $data->time = Carbon::parse($data->update_at)->locale('id')->translatedFormat('H:i');
        $data->date = Carbon::parse($data->update_at)->locale('id')->translatedFormat('d F Y');
        // dd($data->articles);
        return view('guest.business', compact('data'));
    }
}
