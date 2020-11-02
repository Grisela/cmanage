<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Auth;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::latest()->paginate(10);

        // return view('admin.content.index')->with('post', $post);
        return view('layouts.content.index')->with('post', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::guest()){
            if(auth()->user()->rolecheck == 1){
                $request->validate([
                    'title'=>'required',
                    'body'=>'required',
                    'post_image' => 'image|nullable|max:1999',
                ]);
        
                if($request->hasFile('post_image')){
                    $fileNameWithExt = $request->file('post_image')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('post_image')->getClientOriginalExtension();
                    $fileNameToStore = $fileName.'.'.time().'.'.$extension;
                    $path = $request->file('post_image')->storeAs('public/post_image', $fileNameToStore);
                }else{
                    $fileNameToStore = 'noimage.jpg';
                }
                
                $post = new Post([
                    'title' => $request->get('title'),
                    'body' => $request->get('body'),
                ]);
        
                $post->user_id = auth()->user()->id;
                $post->post_image = $fileNameToStore;
                $post->save();
        
                return redirect('home/')->with('Success', "Post Created");
            }
            return redirect('home/')->with('error', "Forbidden");
        }
        return redirect('home/')->with('error', "Forbidden");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('layouts.post.show')->with('post', $post); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::guest()){
            if(auth()->user()->rolecheck == 1){
                $post = Post::find($id);
                return view('admin.post.edit')->with('post', $post);
            }
            return redirect('/home')->with('error', 'forbidden');
        }
        return redirect('/home')->with('error', 'forbidden');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::guest()){
            if(auth()->user()->rolecheck == 1){
                $request->validate([
                    'title'=>'required',
                    'body'=>'required',
                ]);
        
                if($request->hasFile('post_image')){
                    $fileNameWithExt = $request->file('post_image')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('post_image')->getClientOriginalExtension();
                    $fileNameToStore = $fileName.'.'.time().'.'.$extension;
                    $path = $request->file('post_image')->storeAs('public/post_image', $fileNameToStore);
                }
                
                $post = Post::find($id);
                $post->title = $request->get('title');
                $post->body = $request->get('body');
                if($request->hasFile('post_image')){
                    if($post->post_image != 'noimage.jpg') {
                        Storage::delete('public/post_image/' . $post->post_image);
                    }
                    $post->post_image = $fileNameToStore;
                }
        
                $post->save();
        
                return redirect('home/')->with('Success', "Post Updated");
            }
            return redirect('/home')->with('error', "forbidden");
        }
        return redirect('/home')->with('error', "forbidden");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::guest()){
            if(auth()->user()->rolecheck == 1){
                $post = Post::find($id);
    
            if($post->post_image != 'noimage.jpg'){
                Storage::delete('public/post_image/'.$post->post_image);
            }
    
            $post->delete();
    
            return redirect('home/')->with('Success', "Post has been deleted");
            }
            return redirect('home/')->with('error', "forbidden");
        }
        return redirect('home/')->with('error', "forbidden");
    }
}
