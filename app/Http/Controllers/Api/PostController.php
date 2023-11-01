<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\PutPostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::with('category')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        return response()->json(Post::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function update(PutPostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json($post);
        // return response()->json($post);
    }

    public function upload(Request $request, Post $post)
    {
        $request->validate([
            'image' => "required|mimes:jpeg,png,gif|max:10240"
        ]);

        Storage::disk("public_upload")->delete("image/otro/".$post->image);
        $data['image'] = $fileName = time().".".$request['image']->extension();
        $request->image->move(public_path('image/otro'),$fileName);
        $post->update($data);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json("Post eliminado con exito");
    }

    public function all()
    {
        return response()->json(Post::get());
    }

    public function slug($slug)
    {
        return response()->json(Post::where('slug',$slug)->first());
    }

    // public function slug(Post $post)
    // {
    //     return response()->json($post);
    //     // return response()->json(Post::where('slug',$post->slug)->first());
    // }

}
