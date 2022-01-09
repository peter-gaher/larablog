<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Tag;
use App\Post;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posts = POST::latest('created_at')->get();
		return view('post.index')
			->with('posts', $posts);
	}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$tags = Tag::all();
		return view('post.create')
			->with('tags', $tags)
			->with('title', 'Add new post');
	}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePostRequest $request)
    {
		$post = Auth::user()->posts()->create($request->all());
		$post->tags()->sync($request->get('tags') ?: []);

		flash()->success('Pridanie sa podarilo!');
		return redirect()->route('post.show', $post->slug);
	}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
		$post = Post::whereSlug($slug)->firstOrFail();
		return view('post.show')
			->with('post', $post);
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

		$this->authorize('edit-post', $post);

		$tags = Tag::all();

		return view('post.edit')
			->with('title', 'Edit post')
			->with('post', $post)
			->with('tags', $tags);
	}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(SavePostRequest $request, $id)
    {
		$post = Post::findOrFail($id);

		$this->authorize('edit-post', $post);

		$post->update($request->all());
		$post->tags()->sync($request->get('tags') ?: []);

		flash()->success('Aktualizácia sa podarila!');
		return redirect()->route('post.show', $post->slug);
	}



	public function delete($id)
	{
		$post = Post::findOrFail($id);

		$this->authorize('delete-post', $post);

		return view('post.delete')
			->with('post', $post);
	}



	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		/*$post = Post::findOrFail($id);
		if ($post->user_id !== \Auth::id()){
			abort(403, 'Nemáš oprávnenie mazať!');
		}
		$post->delete();*/

		//\Auth::user()->posts()->findOrFail($id)->delete();

		$post = Post::findOrFail($id);

		$this->authorize('delete-post', $post);

		$post->delete();

		flash()->success('Mazanie sa podarilo!');
		return redirect('/');
	}
}
