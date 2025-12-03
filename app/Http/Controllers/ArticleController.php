<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::all()->sortByDesc('created_at');
        return view('articles.index', compact('articles'));
    }

    /**
     * Display a listing of the resource by user
     */
    public function index_by_user(User $user)
    {
        //
        if (!$user) {
        abort(404, 'Gebruiker niet gevonden');
        }

        if (Auth::user()->id !== $user->id) {
        abort(403, 'Toegang geweigerd: verkeerde gebruiker');
        }
    
        $articles = $user->articles;
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        // Maakt een nieuw item aan met de gevalideerde gegevens
        Article::create($validated);

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        $comments = Comment::all()->where('article_id', $article->id)->sortByDesc('created_at');
        return view('articles.show', compact('article','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
        $validated = $request->validated();

        $article->update($validated);

        return redirect()->route('articles.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return redirect()->route('articles.user.index');
    }
}
