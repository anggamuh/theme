<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\SourceCode;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function formatCount($number)
    {
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'k'; // contoh: 1500 → 1.5k
        }
        return (string) $number;
    }

    public function dashboard() {
        $sc = $this->formatCount(SourceCode::all()->count());
        $spintax = $this->formatCount(Article::where('article_type', 'spintax')->get()->count());
        $spin = $this->formatCount(ArticleShow::whereHas('articles', function ($query) {
            $query->where('article_type', 'spintax');
        })->count());

        $unique = $this->formatCount(Article::where('article_type', 'unique')->get()->count());

        return view('dashboard', compact('sc', 'spintax', 'spin', 'unique'));
    }
}
