<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size');

        $query = Article::with('articleCategory', 'manager')->orderBy('created_at', 'desc');

        if ($size || $size == 0) {
            $query->limit($size);
        }

        $articles = $query->get();

        return response()->json($articles);
    }

    public function getArticlesByCategory($id)
    {
        $articles = Article::where('article_category_id', $id)->with('articleCategory', 'manager')->get();
        return response()->json($articles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'article_category_id' => 'required|integer|exists:article_categories,id',
            'manager_id' => 'required|integer|exists:managers,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $article = Article::create($request->all());
        $image = $request->file('image');
        $imageName = $article->id . '.' . $image->extension();
        $image->move(public_path('images/articles'), $imageName);

        $article->image = 'images/articles/' . $imageName;
        $article->save();

        return response()->json($article->load('articleCategory'));
    }

    public function show($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->update($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $article->id . '.' . $image->extension();
            $image->move(public_path('images/articles'), $imageName);
            $article->image = 'images/articles/' . $imageName;
        }

        $article->save();

        return response()->json($article->load('articleCategory'));
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully']);
    }
}