<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PutPostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request; 
use App\Http\Requests\StorePostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);

        if(!Gate::allows('index',$posts[0])) {
            abort(403);
        }
        // dd(Gate::allows('index',$posts[0]));
        // dd(Gate::allows('index'));

        // dd(Category::find(1)->posts);
        // return route("post.create");

        // return redirect("/post/create");
        // return redirect()->route("post.create");
        // return to_route('post.create');

        
        echo view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id','title');
        $post = new Post();

        if(!Gate::allows('create',$post)) {
            abort(403);
        }
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


        // $post = Post::create($request->validated()); 

        $post = new Post($request->validated());

        // Auth::user()->posts()->save($post);
        
        if(!Gate::allows('create',$post)) {
            abort(403);
        }
        Auth::user()->posts()->save($post);

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

        //test
        // if(Gate::any(['update','view'],$post))
        // {
        //     dd(true);
        // }

        // if(Gate::none(['update','view'],$post))
        // {
        //     dd(true);
        // }

        // if(Auth::user()->can('update',$post))
        // {
        //     dd(true);
        // }

        // if(Gate::forUser(User::find(2))->allows('update',$post))
        // {
        //     dd(true);
        // }

        // Gate::allowIf(function(User $user){
        //     return !$user->isAdmin();

        // });

        // Gate::allowIf(
        //     fn(User $user) =>
        //     $user->isAdmin()
        // );

        // Gate::denyIf(
        //     fn(User $user) =>
        //     !$user->isAdmin()
        // );

        Gate::authorize('create',$post);
        //test


        // if(!Gate::allows('view',$post))
        // {
        //     return abort(403);
        // }
        return view('dashboard.post.show', compact('post'));
        // echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // dd(Gate::inspect('update',$post));
        // if(!Gate::allows('update',$post))
        if(!Gate::inspect('update',$post))
        {
            return abort(403);
        }
        $categories = Category::pluck('id','title');

        // echo view('dashboard.post.edit',compact('categories','post'));
        return view('dashboard.post.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutPostRequest $request, Post $post)
    {
        // dd($request->image);
            // dd($request->validated()['image']->getClientOriginalName());
        
        if(!Gate::allows('update-post',$post))
        {
            return abort(403);
        }

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

        if(!Gate::allows('delete',$post))
        {
            return abort(403);
        }

        echo "Destroy";
        $post->delete();
        return to_route('post.index')->with('status', 'Registro eliminado!');
    }
}
