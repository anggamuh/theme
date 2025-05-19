<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Template::all();
        $data->transform(function ($data) {
            $data->image = $data->image ? asset('storage/images/template/'.$data->image) : asset('assets/images/verplaceholder.webp');
            return $data;
        });
        return view('admin.template.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.template.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:'.Template::class,
        ]);

        $newdata = new Template;

        $newdata->name = $request->name;
        $newdata->bg_type = $request->bg_type;
        $newdata->head_type = $request->header;
        $newdata->gallery_type = $request->gallery;
        $newdata->desc_main_color = $request->desc_main_color;
        $newdata->desc_second_color = $request->desc_second_color;
        $newdata->desc_text_color = $request->desc_text_color;
        $newdata->contact_main_color = $request->contact_main_color;
        $newdata->contact_second_color = $request->contact_second_color;
        if ($newdata->bg_type === "normal") {
            $newdata->bg_main_color = $request->bg_normal_color;
        } elseif ($newdata->bg_type === "gradient") {
            $newdata->bg_main_color = $request->bg_main_color;
            $newdata->bg_second_color = $request->bg_second_color;
        } elseif ($newdata->bg_type === "image") {
            if ($request->hasFile('bg_image')) {
                $imageFile = $request->file('bg_image');
                $imageName = time();
                $imagePath = public_path('storage/images/template/background/');
    
                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageFile->getPathname());
                $imageFullPath = $imagePath . $imageName . '.webp';
                $image->save($imageFullPath);
    
                $newdata->bg_image = $imageName . '.webp';
            }
        }

        $newdata->save();

        return redirect()->route('template.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        return view('admin.template.edit', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        //
    }

    public function editimage($id, Request $request) {
        $template = Template::find($id);
        if ($request->hasFile('thumbnail')) {
            if ($template->image) {
                $path = public_path('storage/images/template/' . $template->image);

                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $imageFile = $request->file('thumbnail');
            $imageName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $imagePath = public_path('storage/images/template/');

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());
            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $template->image = $imageName . '.webp';
        }
        $template->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, template $template)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:'.Template::class,
        ]);
        
        $template->name = $request->name;
        $template->bg_type = $request->bg_type;
        $template->head_type = $request->header;
        $template->gallery_type = $request->gallery;
        $template->desc_main_color = $request->desc_main_color;
        $template->desc_second_color = $request->desc_second_color;
        $template->desc_text_color = $request->desc_text_color;
        $template->contact_main_color = $request->contact_main_color;
        $template->contact_second_color = $request->contact_second_color;

        if ($template->bg_image) {
            $path = public_path('storage/images/template/background/' . $template->bg_image);
        
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($template->bg_type === "normal") {
            $template->bg_main_color = $request->bg_normal_color;
        } elseif ($template->bg_type === "gradient") {
            $template->bg_main_color = $request->bg_main_color;
            $template->bg_second_color = $request->bg_second_color;
        } elseif ($template->bg_type === "image") {
            if ($request->hasFile('bg_image')) {
                $imageFile = $request->file('bg_image');
                $imageName = time();
                $imagePath = public_path('storage/images/template/background/');
    
                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageFile->getPathname());
                $imageFullPath = $imagePath . $imageName . '.webp';
                $image->save($imageFullPath);
    
                $template->image = $imageName . '.webp';
            }
        }

        $template->save();

        return redirect()->route('template.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        if ($template->bg_image) {
            $path = public_path('storage/images/template/background/' . $template->bg_image);
        
            if (file_exists($path)) {
                unlink($path);
            }
        }
        
        $template->delete();

        return redirect()->back();
    }
}
