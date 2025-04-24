<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PhoneNumber::all();
        return view('admin.phone-number.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = ArticleTag::whereNull('phone_number_id')->get();
        $article = Article::whereNull('phone_number_id')->get();
        return view('admin.phone-number.create', compact('category', 'article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $newtlp = new PhoneNumber;

        $newtlp->no_tlp = preg_replace('/^0/', '+62', $request->no_tlp);
        $newtlp->type = $request->type;

        $newtlp->save();

        if ($newtlp->type === 'category') {
            if ($request->category) {
                foreach ($request->category as $item) {
                    $category = ArticleTag::find($item);
                    $category->phone_number_id = $newtlp->id;
                    $category->save();
                }
            }
        } elseif ($newtlp->type === 'article') {
            if ($request->article) {
                foreach ($request->article as $item) {
                    $article = Article::find($item);
                    $article->phone_number_id = $newtlp->id;
                    $article->save();
                }
            }
        }

        return redirect()->route('phone-number.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PhoneNumber $phoneNumber)
    {
        $category = ArticleTag::where('phone_number_id', '!=', $phoneNumber->id)->orWhereNull('phone_number_id')->get();
        $article = Article::where('phone_number_id', '!=', $phoneNumber->id)->orWhereNull('phone_number_id')->get();
        return view('admin.phone-number.edit', compact('phoneNumber', 'category', 'article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhoneNumber $phoneNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber->no_tlp = preg_replace('/^0/', '+62', $request->no_tlp);

        if ($phoneNumber->type != 'main') {
            $phoneNumber->type = $request->type;
        }

        $phoneNumber->save();

        if ($phoneNumber->type === 'category') {
            ArticleTag::where('phone_number_id', $phoneNumber->id)->update(['phone_number_id' => null]);
    
            if ($request->category) {
                foreach ($request->category as $item) {
                    $category = ArticleTag::find($item);
                    $category->phone_number_id = $phoneNumber->id;
                    $category->save();
                }
            }
        } elseif ($phoneNumber->type === 'article') {
            Article::where('phone_number_id', $phoneNumber->id)->update(['phone_number_id' => null]);
    
            if ($request->article) {
                foreach ($request->article as $item) {
                    $article = Article::find($item);
                    $article->phone_number_id = $phoneNumber->id;
                    $article->save();
                }
            }
        }

        return redirect()->route('phone-number.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhoneNumber $phoneNumber)
    {
        //
    }
}
