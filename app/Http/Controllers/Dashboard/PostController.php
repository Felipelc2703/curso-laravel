<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PutPostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request; 
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd(Category::find(1)->posts);
        // return route("post.create");

        // return redirect("/post/create");
        // return redirect()->route("post.create");
        // return to_route('post.create');

        $posts = Post::paginate(5);
        echo view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id','title');
        $post = new Post();
        // $categories = Category::get('id','titulo');

        // dd($categories);
        echo view('dashboard.post.create',compact('categories','post'));

        
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    { 
        // $request->validated()['slug'] == 'hola mundo';
        // $data = $request->validated();
        // $data['slug'] = 'hola';

        // $data['slug'] = Str::slug($data['title']);

        // dd($data);
        // echo(request('title'));
        // dd($request->all());

        // dd($request->validated());
        Post::create($request->validated());  

        // return redirect("/post/create");
        // return redirect()->route("post.create");
        
        return to_route('post.index')->with('status', 'Registro creado!');
        // return to_route('post.index');
        // echo "sdsddsds";
    }
    // public function store(Request $request)
    // { 
    //     // echo(request('title'));
    //     // dd($request->all());

    //     $validated = Validator::make($request->all(),StorePostRequest::myRules());
    //     // $validated = $request->validate(StorePostRequest::myRules());
    //     // $validated = $request->validate([
    //     //     "title" => "required|min:5|max:255",
    //     //     "slug" => "required|min:5|max:255",
    //     //     "content" => "required|min:7",
    //     //     "category_id" => "required|integer",
    //     //     "description" => "required|min:7",
    //     //     "posted" => "required",
    //     // ]);

    //     dd($validated->errors());


    //     dd($request->all());

    //     Post::create($request->all());  
    //     // echo "sdsddsds";
    // }
    // public function store(StorePostRequest $request)
    // { 
    //     // echo(request('title'));
    //     // dd($request->all());

    //     Post::create($request->all());  
    //     // echo "sdsddsds";
    // }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', compact('post'));
        // echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id','title');

        echo view('dashboard.post.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutPostRequest $request, Post $post)
    {
        // dd($request->image);
            // dd($request->validated()['image']->getClientOriginalName());
            
        $data = $request->validated();
        if(isset($data['image']))
        {
            $data['image'] = $fileName = time().".".$data['image']->extension();
            $request->image->move(public_path('image/otro'),$fileName);
            // dd($fileName);
        }
        $post->update($data);
        // $request->session()->flash('status', 'Registro actualizado!');
        // return view('dashboard.post.index');
        return to_route('post.index')->with('status', 'Registro actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        echo "Destroy";
        $post->delete();
        return to_route('post.index')->with('status', 'Registro eliminado!');
    }
}
