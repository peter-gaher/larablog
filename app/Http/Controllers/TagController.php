<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
	public function show($id){
		$tag = Tag::findOrFail($id);
		return view('post.index')
			->with('posts', $tag->posts)
			->with('title', $tag->tag);
	}



	public function create()
	{
		$this->authorize('is-admin');
		return view('tag.create')
			->with('title', 'Add new tag');
	}



	public function store(Request $request)
	{
		$this->authorize('is-admin');

		$validator = $this->validator($request->all());
		if ($validator->fails()){
			return back()->withErrors($validator)->withInput();
		}

		Tag::create([
			'tag' => $request->get('tag'),
		]);

		flash()->success('Pridanie sa podarilo!');
		return redirect()->route('admin.tag_list');
	}



	public function delete($id)
	{
		$this->authorize('is-admin');

		$tag = Tag::findOrFail($id);

		return view('tag.delete')
			->with('tag', $tag);
	}



	public function destroy($id)
	{
		$this->authorize('is-admin');

		$tag = Tag::findOrFail($id);
		$tag->delete();

		flash()->success('Mazanie sa podarilo!');
		return redirect()->route('admin.tag_list');
	}



	private function validator(array $data)
	{
		return \Validator::make($data, [
			'tag' => 'required|max:20',
		]);
	}



	public function tag_list()
	{
		$tags = Tag::all();
		return view('tag.tag_list')
			->with('tags', $tags);
	}
}
