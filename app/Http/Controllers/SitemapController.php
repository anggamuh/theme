<?php

namespace App\Http\Controllers;

use App\Models\ArticleShow;
use App\Models\ArticleTag;
use App\Models\User;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setLastModificationDate(now()))
            ->add(Url::create('/artikel')->setLastModificationDate(now()));

        // Dynamically add more URLs if needed, such as from a database
        foreach (User::all() as $model) {
            $slug = $model->slug;
            $sitemap->add(Url::create("/penulis/{$slug}")->setLastModificationDate($model->updated_at));
        }
        foreach (ArticleTag::all() as $model) {
            $slug = $model->slug;
            $sitemap->add(Url::create("/ketegori/{$slug}")->setLastModificationDate($model->updated_at));
        }
        foreach (ArticleShow::where('status', 'publish')->get() as $model) {
            $slug = $model->slug;
            $sitemap->add(Url::create("/{$slug}")->setLastModificationDate($model->updated_at));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        // return response()->download(public_path('sitemap.xml'));
        return redirect('/sitemap.xml');
    }
}
