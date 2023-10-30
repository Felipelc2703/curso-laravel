<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PutCategoryRequest;
// use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        // Category::paginate(5);

        // return response()->json(Category::paginate(10));
        return response()->json(Category::paginate(5));
    }
    
    public function store(StoreCategoryRequest $request)
    {

        return response()->json(Category::create($request->validated()));

        // dd($request);
    }

    
    public function show(Category $category)
    {
        return response()->json($category);
    }

    
    public function update(PutCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());   
        return response()->json($category);
    }

    
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json("Eliminado"); 
    }

    public function all()
    {
        return response()->json(Category::get());
    }

    public function getPostCategory(Category $category)
    {

        // $posts = Post::join('categories','categories.id', '=','posts.category_id')->select('posts.*','categories.title as category')
        //                                 ->where('category_id',$category->id)->toSql();

        $posts = Post::with("category")
                    ->where('category_id',$category->id)->toSql();

        // $posts = Post::where('category_id', $category->id)->toSql();

        return response()->json($posts);
    }

    public function slug($slug)
    {
        return response()->json(Category::where('slug',$slug)->first());
    }

    // public function slug(Post $post)
    // {
    //     return response()->json(Category::where('slug',$post->slug)->first());
    // }
}
