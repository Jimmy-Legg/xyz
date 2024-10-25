<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tracks')->orderBy('name')->get();
        return view('app.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $tracks = $category->tracks()->with('week', 'user')->withCount('likes')->orderByDesc('likes_count')->paginate(20);
        return view('app.categories.show', compact('category', 'tracks'));
    }
}
