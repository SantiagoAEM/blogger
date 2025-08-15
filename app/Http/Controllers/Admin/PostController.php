<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderby('id','desc')->paginate();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([    
            'title'=> 'required',
            'slug'=> 'required|unique:posts',
            'category_id'=> 'required|exists:categories,id',
        ]);
        
        $data['user_id'] = auth('web')->id();
        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view ('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data =$request->validate([
            'title'=> 'required',
            'slug' => "required|unique:posts,slug,{$post->id}", 
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|image',
            'tags'  => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_published'=> 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            if ($post->image_path) {
                Storage::delete($post->image_path);
            }

           $data['image_path'] = Storage::put('posts/images', $request->image);
        }

        $post->update($data);
        $post->tags()->sync($data['tags'] ?? []);
        
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Saved',
            'text' => 'Post updated correctly'
        ]);
       

        return redirect()->route('admin.posts.edit',$post); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::delete($post->image_path);            
        }
        
        $post->delete();

          session()->flash('swal',[
            'icon'=>'succsess',
            'title'=>'!Post eliminado con exito¡',
            'text'=>'El Post eliminado correctamente'
        ]);

        return redirect()->route('admin.posts.index');
    }
}
