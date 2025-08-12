<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        $tags = Tag::orderby('id','desc') -> get();
        return view ('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $tags = Tag::all();
      return view('admin.tags.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'name'=> 'required|string|min:3|max:255|unique:tags,name',
       ]);

       Tag::create($data);

       session()->flash('swal',[
            'icon'=>'succsess',
            'title'=>'!Tag creado con exito¡',
            'text'=>'El tag creado correctamente'
       ]);

      return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
         $data = $request->validate([
            'name'=> "required|string|min:3|max:255|unique:tags,name, {$tag -> id}",
       ]);

        $tag->update($request->all());

        session()->flash('swal',[
            'icon'=>'succsess',
            'title'=>'!Tag actualizado con exito¡',
            'text'=>'El tag actualizado correctamente'
        ]);

        return redirect()->route('admin.tags.edit',$tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        session()->flash('swal',[
            'icon'=>'succsess',
            'title'=>'!Tag eliminadi con exito¡',
            'text'=>'El tag eliminado correctamente'
        ]);

        return redirect()->route('admin.tags.index');
    }
}
