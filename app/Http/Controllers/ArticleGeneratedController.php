<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleGallery;
use App\Models\ArticleShow;
use App\Models\ArticleShowGallery;
use App\Models\ArticleTag;
use App\Models\PhoneNumber;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArticleGeneratedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $articleShow = ArticleShow::find($id);
        $tagid = $articleShow->articles->articletag->pluck('id')->toArray();
        $tag = ArticleTag::whereNotIn('id', $tagid)->get();
        $article = Article::find($articleShow->article_id);
        $template = Template::all();
        $phonenumber = PhoneNumber::where('type', '!=', 'main')->where('id', '!=', $articleShow->phone_number_id)->get();
        return view('admin.article.edit-generated', compact('article', 'articleShow', 'tag', 'template', 'phonenumber'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);

        $articleShow = ArticleShow::find($id);
        if ($request->banner) {
            $articleShow->banner = $request->banner;
        }

        $no_tlp = $request->no_tlp;

        if (substr($no_tlp, 0, 1) === '0') {
            $no_tlp = '+62' . substr($no_tlp, 1);
        }

        $phoneNumber = PhoneNumber::firstOrCreate(
            ['no_tlp' => $no_tlp]
        );
        
        $articleShow->phone_number_id = $phoneNumber->id;
        $articleShow->judul = $request->judul;
        $articleShow->slug = Str::slug($articleShow->judul);
        $articleShow->article = $request->article;
        $articleShow->template_id = $request->template_id;
        $articleShow->telephone = $request->tlp;
        $articleShow->whatsapp = $request->wa;

        foreach ($articleShow->articleshowgallery as $gallery) {
            $gallery->delete();
        }
        
        foreach ($request->gallery as $item) {
            $newgalleryshow = new ArticleShowGallery;

            $articlegallery = ArticleGallery::find($item);
            
            $newgalleryshow->article_show_id = $articleShow->id;
            $newgalleryshow->article_gallery_id = $item;
            $newgalleryshow->image = $articlegallery->image;
            $newgalleryshow->image_alt = $articlegallery->image_alt;

            $newgalleryshow->save();
        }

        $articleShow->save();

        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
