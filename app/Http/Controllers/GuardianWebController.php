<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\GuardianWeb;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GuardianWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $data = GuardianWeb::where('url', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
        $data = GuardianWeb::paginate(10);
        }
        $mainCount = Article::whereNull('guardian_web_id')->count();
        return view('admin.guardian.index', compact('data', 'mainCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $article = Article::whereNull('guardian_web_id')->get();

        return view('admin.guardian.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|max:255|unique:'.GuardianWeb::class,
            'article' => 'array',
        ]);

        $newguardian = new GuardianWeb;

        $newguardian->url = $request->url;
        $newguardian->code = strtoupper(Str::random(10));

        $newguardian->save();

        if ($request->has('article') && is_array($request->article)) {
            $newguardian->articles()->attach($request->article);
        }



        return redirect()->route('guardian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, GuardianWeb $guardianWeb)
    {
    $article = Article::whereNull('guardian_web_id')->orWhere('guardian_web_id', $id)->get();

        $guardianWeb = GuardianWeb::find($id);

        return view('admin.guardian.edit', compact('guardianWeb', 'article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuardianWeb $guardianWeb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request, GuardianWeb $guardianWeb)
    {
        $validated = $request->validate([
            'url' => 'required|max:255|unique:' . GuardianWeb::class . ',url,' . $id,
            'article' => 'array',
        ]);

        $guardianWeb = GuardianWeb::find($id);
        
        $guardianWeb->url = $request->url;

        $guardianWeb->save();

        $old = Article::where('guardian_web_id', $guardianWeb->id)->get();
        foreach ($old as $item) {
            $item->guardian_Web_id = null;
            $item->save();
        }

        $articles = Article::whereIn('id', $request->article)->get();
        foreach ($articles as $item) {
            $item->guardian_Web_id = $guardianWeb->id;
            $item->save();
        }
        
        return redirect()->route('guardian.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, GuardianWeb $guardianWeb)
    {
        $guardianWeb = GuardianWeb::find($id);

        $guardianWeb->delete();

        return redirect()->back();
    }
}
