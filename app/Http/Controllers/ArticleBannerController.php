<?php

namespace App\Http\Controllers;

use App\Models\ArticleBanner;
use Illuminate\Http\Request;
use Intervention\Gif\Exceptions\NotReadableException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ArticleBannerController extends Controller
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
        if ($request->hasFile('image_banner')) {
            $image = $request->file('image_banner');
            
            // Ensure the image is a valid instance of UploadedFile
            if ($image instanceof \Illuminate\Http\UploadedFile && $image->isValid()) {
                try {
                    // Get the original filename without the extension
                    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    
                    // Add the current date to the filename
                    $currentDate = now()->format('YmdHis');
                    
                    // Create a new image name
                    $imageName = $originalName . '_' . $currentDate;
                    
                    // Define the image storage path
                    $imagePath = public_path('storage/images/article/banner/');
                    
                    $manager = new ImageManager(new Driver());
                    $imageOptimized = $manager->read($image->getPathname());
                    $imageFullPath = $imagePath . $imageName . '.webp';
                    $imageOptimized->save($imageFullPath);
    
                    // Save the image to the database
                    $newImage = new ArticleBanner();
                    $newImage->article_id = $request->article_id;
                    $newImage->image = $imageName . '.webp';
                    $newImage->image_alt = $imageName . '.webp';
                    $newImage->save();
    
                    // Return the new image data (including ID for deletion) to the frontend
                    return response()->json([
                        'id' => $newImage->id,
                        'url' => asset('storage/images/article/banner/' . $newImage->image),
                    ], 201);
    
                } catch (NotReadableException $e) {
                    return response()->json(['error' => 'Image processing error: ' . $e->getMessage()], 500);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleBanner $articleBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleBanner $articleBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleBanner $articleBanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $articlebanner = ArticleBanner::find($id);
        $path = public_path('storage/images/article/banner/' . $articlebanner->image);
        if (file_exists($path)) {
            unlink($path);
        }

        // Finally, delete the auction
        $articlebanner->delete();
    }
}
