<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\FilterArticleRequest;
use App\Models\Category;
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
        $articles = Article::all()->where('is_premium', 0)->sortByDesc('created_at');
        $categories= Category::all()->sortBy('name');
        return view('articles.index', compact('articles','categories'));
    }

        /**
     * Display a listing of the resource.
     */
    public function index_premium()
    {
        //
        if (Auth::user()->is_premium == 1) {
            $articles = Article::all()->where('is_premium', 1)->sortByDesc('created_at');
            $categories= Category::all()->sortBy('name');
            return view('articles.index', compact('articles','categories'));
        } else {
            return view('articles.get_premium');
        }
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
    
        $articles = $user->articles->sortByDesc('created_at');
        $categories= Category::all()->sortBy('name');
        return view('articles.index', compact('articles', 'categories' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // dd($request);
        $validated = $request->validated();
        // dd($validated);

        // handle uploaded image (input name: "image")
        if ($request->hasFile('myimage')) {
            $path = $request->file('myimage')->store('articles', 'public'); // storage/app/public/articles
            $validated['myimage'] = $path; // adjust attribute name to your articles table (e.g. image, image_path)
        }

        $article = Article::create($validated);
        $article->categories()->attach($validated["category_ids"]);
        $article->user()->associate(Auth::user()->id);
        $article->save();
       
        return redirect()->route('articles.index');
    }

    public function filter(FilterArticleRequest $request)
    {
        $validated = $request->validated();

        $categoryIds = $validated['category_ids'] ?? [];

        if (empty($categoryIds)) {
            return redirect()->route('articles.index');
        }

        $query = Article::query();

        foreach ($categoryIds as $categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        $filtered_articles = $query->with('categories')->get()->sortByDesc('created_at');

        $categories = Category::all()->sortBy('name');

        return view('articles.index', ['articles' => $filtered_articles, 'categories' => $categories]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        $comments = Comment::all()->where('article_id', $article->id)->sortByDesc('created_at');
        $categories = $article->categories()->orderBy('name')->get();
        return view('articles.show', compact('article','comments','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        if (Auth::user()->id !== $article->user_id) {
        abort(403, 'Toegang geweigerd: verkeerde gebruiker');
        }

        $categories = Category::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
        // dd($request);
        $validated = $request->validated();
        // dd($validated);
        if ($request->hasFile('myimage')) {
            $path = $request->file('myimage')->store('articles', 'public'); // storage/app/public/articles
            $validated['myimage'] = $path; // adjust attribute name to your articles table (e.g. image, image_path)
        }

        $article->update($validated);
        $article->categories()->detach();
        $article->categories()->attach($validated["category_ids"]);
        $article->save();

        return redirect()->route('articles.user.index', ['user' => Auth::user()->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return redirect()->route('articles.user.index', ['user' => Auth::user()->id]);
    }
}
