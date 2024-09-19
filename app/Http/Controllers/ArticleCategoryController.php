<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articleCategories = ArticleCategory::all();
        return response()->json($articleCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $articleCategory = ArticleCategory::create([
            'name' => $request->name
        ]);

        return response()->json($articleCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $articleCategory = ArticleCategory::find($id);

        return response()->json($articleCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $articleCategory = ArticleCategory::find($id);

        if (!$articleCategory) {
            return response()->json(['message' => 'Article Category not found'], 404);
        }

        $articleCategory->name = $request->name ?? $articleCategory->name;
        $articleCategory->save();

        return response()->json($articleCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $articleCategory = ArticleCategory::find($id);
        $articleCategory->delete();

        return response()->json($articleCategory);
    }
}
