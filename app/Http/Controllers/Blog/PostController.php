<?php

namespace App\Http\Controllers\Blog;
use App\Models\Blog\Post;
use App\Models\Blog\Category;
use App\Models\Blog\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['author', 'category', 'tags'])
            ->latest('published_at')
            ->paginate(10);

        return view('blog.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // افزایش تعداد بازدیدها
        $post->increment('view_count');
        
        // ثبت اطلاعات بازدید
        $post->views()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id()
        ]);

        return view('blog.posts.show', compact('post'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->published()
            ->with(['author', 'tags'])
            ->latest('published_at')
            ->paginate(10);

        return view('blog.posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
            ->published()
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(10);

        return view('blog.posts.tag', compact('posts', 'tag'));
    }
}