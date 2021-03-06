<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Contracts\Cache\Store;
use Prophecy\Call\Call;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validationRule = [
        "title" => "required|string|max:100",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRule);
        $data = $request->all();
        $newPost = new Post();
        $newPost->title = $data['title'];
        $slug = Str::of($data['title'])->slug("-");
        $newPost->content = $data['content'];
        $newPost->published = isset($data['published']);
        $newPost->category_id = $data['category_id'];
        $count = 1;
        while(Post::where('slug', $slug)->first()){
            $slug = Str::of($data['title'])->slug("-") . "-{$count}";
            $count++;
        }
        $newPost->slug = $slug;

        if(isset($data['image'])){
            $path_image = Storage::put("uploads", $data['image']);
            $newPost->image = $path_image;
        }
        $newPost->save();

        if(isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $request->validate($this->validationRule);
        if($post->title != $data['title']){
            $post->title = $data['title'];
            $slug = Str::of($post->title)->slug('-');
            if($slug != $post->slug){
                $post->slug = $this->getSlug($post->title);
        }
    }
    $post->category_id = $data['category_id'];
    $post->content = $data['content'];
    $post->published = isset($data['published']);

    if(isset($data['image'])){
        $path_image = Storage::put("uploads", $data['image']);
        $post->image = $path_image;
    }
    
        $post->update();
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
    private function getSlug($title){

        $slug = Str::of($title)->slug('-');
        $count = 1;

        while(Post::where('slug', $slug)->first()){
            $slug = Str::of($title)->slug('-').'-{$count}';
            $count++;
        }

        return $slug;

    }
}
