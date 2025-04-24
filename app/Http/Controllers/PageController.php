<?php

namespace App\Http\Controllers;

use App\Models\ArticleShow;
use App\Models\ArticleTag;
use App\Models\PhoneNumber;
use App\Models\Template;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PageController extends Controller
{
    public function home(Request $request) {
        Paginator::currentPageResolver(function () use ($request) {
            return $request->route('page', 1); // default ke halaman 1
        });
        $data = ArticleShow::latest()->paginate(12);

        $data->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            $data->articles->articletag;
            $data->articles->user ;
            return $data;
        });
        $data->withPath("/artikel/page");
        return view('guest.home', compact('data'));
    }

    public function article(Request $request, $username = null, $category = null) {
        Paginator::currentPageResolver(function () use ($request) {
            return $request->route('page', 1); // default ke halaman 1
        });

        if ($username) {
            $data = ArticleShow::whereHas('articles.user', function ($query) use ($username) {
                $query->where('slug', $username);
            })->latest()->paginate(12);

            $user = User::where('slug', $username)->first();
            
            $data->withPath("/penulis/{$user->slug}/page");
            
            $title = 'Penulis : '.$user->name;
        } elseif ($category) {
            $data = ArticleShow::whereHas('articles.articleTag', function ($query) use ($category) {
                $query->where('slug', $category);
            })->latest()->paginate(12);

            $data->withPath("/kategori/{$category}/page");
            
            $category = ArticleTag::where('slug', $category)->first()->tag;
            $title = 'Kategori : '.$category;
        } elseif ($request->search) {
            $data = ArticleShow::where('judul', 'like', '%' . $request->search . '%')->latest()->paginate(12);

            $data->withPath("/artikel/page");
            $title = 'Pecaharian : '.$request->search;
        } else {
            $data = ArticleShow::latest()->paginate(12);

            $data->withPath("/artikel/page");
            $title = 'Artikel Terbaru';
        }

        $data->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            $data->articles->articletag;
            $data->articles->user ;
            return $data;
        });
        return view('guest.article', compact('data', 'title'));
    }

    public function business($slug) {
        $data = ArticleShow::where('slug', $slug)->first();
        
        $template = $data->template;

        // dd($data->articles->phoneNumber);
        if ($data->articles->phoneNumber) {
            $data->no_tlp = $data->articles->phoneNumber->no_tlp;
        } elseif ($data->articles->articletag->first()?->phonenumber) {
            $data->no_tlp = $data->articles->articletag->first()->phoneNumber->no_tlp;
        } else {
            $data->no_tlp = optional(PhoneNumber::first())->no_tlp;
        }

        $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
        // dd($data->articles);
        return view('guest.business', compact('data', 'template'));
    }
}
