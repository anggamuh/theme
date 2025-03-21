<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleBanner;
use App\Models\ArticleGallery;
use App\Models\ArticleShow;
use App\Models\ArticleShowGallery;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ArticleShowController extends Controller
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
        return view('admin.article.create-unique');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Article
        $newarticle = new Article;

        $newarticle->judul = $request->judul;
        $newarticle->article = $request->article;

        // Cek apakah link adalah YouTube
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $request->link, $matches)) {
            $videoId = $matches[1];
            $newarticle->video_type = "youtube";
            $newarticle->youtube = "https://www.youtube.com/embed/{$videoId}";
            $newarticle->tiktok = null;
        } elseif (preg_match('/(?:www\.)?tiktok\.com\/(@[\w.-]+)\/video\/(\d+)/', $request->link, $matches)) {
            $newarticle->video_type = "tiktok";
            $newarticle->youtube = null;
            $newarticle->tiktok = "https://www.tiktok.com/{$matches[0]}";
        } else {
            $newarticle->video_type = "none";
            $newarticle->youtube = null;
            $newarticle->tiktok = null;
        }

        $newarticle->save();
        
        $newbanner = new ArticleBanner;

        $newbanner->article_id = $newarticle->id;

        // Banner
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time();
            $imagePath = public_path('storage/images/article/banner/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $newbanner->image = $imageName . '.webp';
            $newbanner->image_alt = $imageName;
        }
        
        $newbanner->save();

        // Tag
        if ($request->tag) {
            foreach ($request->tag as $item) {
                $newarticletag = new ArticleTag;
                
                $newarticletag->article_id = $newarticle->id;
                $newarticletag->tag = ucfirst($item);

                $newarticletag->save();
            }
        }

        // Gallery
        if ($request->has('image_gallery') && !empty($request->image_gallery)) {
            foreach ($request->image_gallery as $image) {
                $newgallery = new ArticleGallery;
                $newgallery->article_id = $newarticle->id;
        
                // Pastikan image adalah instance dari UploadedFile
                if ($image instanceof \Illuminate\Http\UploadedFile && $image->isValid()) {
                    // Ambil nama file tanpa ekstensi
                    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    
                    // Tambahkan tanggal saat ini
                    $currentDate = now()->format('YmdHis');
                    
                    // Gabungkan nama file dan tanggal input
                    $imageName = $originalName . '_' . $currentDate;
        
                    $imagePath = public_path('storage/images/article/gallery/');

                    if (!File::exists($imagePath)) {
                        File::makeDirectory($imagePath, 0755, true);
                    }
        
                    $manager = new ImageManager(new Driver());
                    $imageOptimized = $manager->read($image->getPathname());
                    $imageFullPath = $imagePath . $imageName . '.webp';
                    $imageOptimized->save($imageFullPath);
        
                    // Simpan nama file dengan ekstensi .webp
                    $newgallery->image = $imageName . '.webp';
                    $newgallery->image_alt = $imageName;
                }
        
                $newgallery->save();
            }
        }

        // Article Show
        $newarticleshow = new ArticleShow;

        $newarticleshow->article_id = $newarticle->id;
        $newarticleshow->banner = $newbanner->image;
        $newarticleshow->judul = $newarticle->judul;
        $newarticleshow->article = $newarticle->article;

        $newarticleshow->save();

        // Article Gallery Show
        $newarticlegallery = ArticleGallery::where('article_id', $newarticle->id)->get();

        foreach ($newarticlegallery as $item) {
            $newgalleryshow = new ArticleShowGallery;
            
            $newgalleryshow->article_show_id = $newarticleshow->id;
            $newgalleryshow->image = $item->image;
            $newgalleryshow->image_alt = $item->image_alt;

            $newgalleryshow->save();
        }

        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleShow $newarticleShow)
    {
        // dd($newarticleShow);
        return view('admin.article.edit-unique', compact('articleShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleShow $newarticleShow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleShow $newarticleShow)
    {
        // dd($request);
        $newarticle = Article::find($newarticleShow->article_id);

        $newarticle->judul = $request->judul;
        $newarticle->article = $request->article;

        // Cek apakah link adalah YouTube
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $request->link, $matches)) {
            $videoId = $matches[1];
            $newarticle->video_type = "youtube";
            $newarticle->youtube = "https://www.youtube.com/embed/{$videoId}";
            $newarticle->tiktok = null;
        } elseif (preg_match('/(?:www\.)?tiktok\.com\/(@[\w.-]+)\/video\/(\d+)/', $request->link, $matches)) {
            $newarticle->video_type = "tiktok";
            $newarticle->youtube = null;
            $newarticle->tiktok = "https://www.tiktok.com/{$matches[0]}";
        } else {
            $newarticle->video_type = "none";
            $newarticle->youtube = null;
            $newarticle->tiktok = null;
        }

        $newarticle->save();
        
        $banner = null;

        if ($request->hasFile('image')) {
            $banner = ArticleBanner::where('article_id', $newarticleShow->article_id)->first();

            $path = public_path('storage/images/article/banner/' . $banner->image);

            if (file_exists($path)) {
                unlink($path);
            }

            $imageFile = $request->file('image');
            $imageName = time();
            $imagePath = public_path('storage/images/article/banner/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $banner->image = $imageName . '.webp';
            $banner->image_alt = $imageName;

            $banner->save();
        }

        // Tag
        if ($request->tag) {
            foreach ($request->tag as $item) {
                $tag = ArticleTag::where('article_id', $newarticleShow->article_id)->where('tag', $item)->first();
        
                if (!$tag) {
                    $newarticletag = new ArticleTag;
                    $newarticletag->article_id = $newarticleShow->article_id;
                    $newarticletag->tag = ucfirst($item);
                    $newarticletag->save();
                }
            }
        
            // Hapus tag yang tidak ada dalam request
            ArticleTag::where('article_id', $newarticleShow->article_id)->whereNotIn('tag', $request->tag)->delete();
        }

        if ($banner) {
            $newarticleShow->banner = $banner->image;
        }
        $newarticleShow->judul = $newarticle->judul;
        $newarticleShow->slug = Str::slug($newarticleShow->judul);
        $newarticleShow->article = $newarticle->article;

        $newarticleShow->save();

        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleShow $newarticleShow)
    {
        //
    }
}
