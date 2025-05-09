<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Post;
use App\Models\Blog\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment($validated);
        $comment->post_id = $post->id;
        
        if (auth()->check()) {
            $comment->user_id = auth()->id();
            $comment->status = 'approved'; // تایید خودکار نظرات کاربران لاگین کرده
        } else {
            $request->validate([
                'author_name' => 'required|string|max:255',
                'author_email' => 'required|email|max:255',
            ]);
            
            $comment->author_name = $request->author_name;
            $comment->author_email = $request->author_email;
            $comment->status = 'pending'; // نیاز به تایید برای کاربران مهمان
        }
        
        $comment->author_ip = $request->ip();
        $comment->author_user_agent = $request->userAgent();
        $comment->save();

        return back()->with('success', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده می‌شود.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();
        
        return back()->with('success', 'نظر با موفقیت حذف شد.');
    }
}