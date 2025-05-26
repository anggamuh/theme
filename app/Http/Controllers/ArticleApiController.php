<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\ArticleTag;
use App\Models\GuardianWeb;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    private function findWebByCode($code)
    {
        $web = GuardianWeb::where('code', $code)->first();

        if (!$web) {
            return response()->json([
                'success' => false,
                'message' => 'Kode tidak ditemukan.',
            ], 404);
        }

        return $web;
    }

    public function index(Request $request, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $articleIds = $web->articles->pluck('id');

        $perPage = 12;

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->paginate($perPage);

        $trend = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->orderBy('view', 'desc')->take(6)->get();

        $articles->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });
        
        $trend->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $articles,
            'trend' => $trend,
        ]);
    }

    public function indexUser(Request $request, $user, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $user = User::where('slug', $user)->first();

        $articleIds = $web->articles->pluck('id');

        $perPage = 12;

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->whereHas('articles.user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->paginate($perPage);

        $articles->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $articles,
            'user' => $user->name,
        ]);
    }

    public function indexCategory($category, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $category = ArticleCategory::where('slug', $category)->first();
        
        $articleIds = $web->articles->pluck('id');

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->whereHas('articles.articlecategory', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    public function indexTag($tag, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $tag = ArticleTag::where('slug', $tag)->first();
        
        $articleIds = $web->articles->pluck('id');

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->whereHas('articles.articletag', function ($query) use ($tag) {
                $query->where('tag_id', $tag->id);
            })
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    public function landingPage($slug, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $articleIds = $web->articles->pluck('id');

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->first();

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }
}
