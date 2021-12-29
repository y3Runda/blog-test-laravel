<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('title')->get();
        $posts = Post::paginate(5);
        return view('pages.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function getPostsByCategory($slug)
    {
        $categories = Category::orderBy('title')->get();
        $current_category = Category::where('slug', $slug)->first();
        return view('pages.index', [
            'posts' => $current_category->posts()->paginate(5),
            'categories' => $categories,
        ]);
    }

    public function getPost($slug_category, $slug_post)
    {
        $post = Post::where('slug', $slug_post)->first();
        return view('pages.article', [
            'post' => $post,
        ]);
    }
}
