<?php

namespace App\Http\Controllers;

use App\Models\SourceCode;
use Illuminate\Http\Request;

class SourceCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SourceCode::all();
        return view('admin.source-code.index', compact('data'));
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
        // dd($request);
        $newsc = new SourceCode;

        $newsc->title = $request->title;
        $newsc->content = implode(',', $request->content);

        $newsc->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SourceCode $sourceCode)
    {
        $tags = explode(',', $sourceCode->content); // pisahkan berdasarkan koma
        $tags = array_map('trim', $tags); // hilangkan spasi di tiap elemen
        $tags = array_filter($tags); // hilangkan tag kosong

        $tags = array_map(function ($tag) {
            return (object) ['tag' => $tag];
        }, $tags);

        $sourceCode->tag = $tags;

        // dd($sourceCode->tag);
        return view('admin.source-code.edit', compact('sourceCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SourceCode $sourceCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SourceCode $sourceCode)
    {
        // dd($sourceCode);
        $sourceCode->title = $request->title;
        $sourceCode->content = implode(',', $request->content);

        $sourceCode->save();

        return redirect()->route('source-code.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SourceCode $sourceCode)
    {
        $sourceCode->delete();

        return redirect()->back();
    }
}
