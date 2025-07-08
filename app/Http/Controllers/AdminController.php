<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\GuardianWeb;
use App\Models\SourceCode;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $data = GuardianWeb::all();

        $data->transform(function ($data) {
            $data->spintaxcount = $data->articles->where('article_type', 'spintax')->count();

            $data->spincount = ArticleShow::whereHas('articles', function ($query) use ($data) {
                $query->where('guardian_web_id', $data->id)
                      ->where('article_type', 'spintax');
            })->count();

            $articleIds = $data->articles->pluck('id');
            $data->categories = ArticleCategory::whereHas('articles', function ($query) use ($data) {
                $query->where('guardian_web_id', $data->id);
            })->select(['category', 'slug'])->get();


            $data->uniquecount = $data->articles->where('article_type', 'unique')->count();
            return $data;
        });

        $manual = new \stdClass();
        $manual->id = null;
        $manual->url = 'Main';

        $manual->categories = ArticleCategory::whereHas('articles', function ($query) {
                $query->whereNull('guardian_web_id');
            })->select(['category', 'slug'])->get();

        $manual->spintaxcount = Article::whereNull('guardian_web_id')->where('article_type', 'spintax')->count();
        $manual->spincount = ArticleShow::whereHas('articles', function ($query) {
            $query->whereNull('guardian_web_id')->where('article_type', 'spintax');
        })->count();
        $manual->uniquecount = Article::whereNull('guardian_web_id')->where('article_type', 'unique')->count();

        $data->prepend($manual);

        $sc = SourceCode::all()->count();
        $spintax = Article::where('article_type', 'spintax')->get()->count();
        $spin = ArticleShow::whereHas('articles', function ($query) {
            $query->where('article_type', 'spintax');
        })->count();
        $unique = Article::where('article_type', 'unique')->get()->count();
        return view('dashboard', compact('data', 'sc', 'spintax', 'spin', 'unique'));
    }
}
