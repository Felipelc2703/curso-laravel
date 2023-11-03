<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $posts = Post::where('posted','yes')->paginate(2);
        return view('web.blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show2(Post $post): string|View
    {

        if(Cache::has('post_show_'.$post->id))
        {
            return response()->json(Cache::get('post_show'-$post->id));
        } else {

            $cacheView = view('web.blog.show',compact('post'))->render();
            
            Cache::put('post_show'.$post->id,$cacheView);

            return $cacheView;
        }


        // return view('web.blog.show',compact('post'));
    }
}
