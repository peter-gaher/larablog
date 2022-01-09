<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class UserController extends Controller
{
	public function show($id){
		$user = User::findOrFail($id);
		return view('post.index')
			->with('posts', $user->posts)
			->with('title', $user->email);
	}



	public function create()
	{
		$this->authorize('is-admin');
		return view('auth.create')
			->with('title', 'Add new user');
	}



	public function store(Request $request)
	{
		$this->authorize('is-admin');

		$validator = $this->validator($request->all());
		if ($validator->fails()){
			return back()->withErrors($validator)->withInput();
		}

		$password_visible = $request->get('password');

		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => bcrypt($password_visible),
			'role_id' => $request->get('role_id'),
		]);

		$this->html_email($user, $password_visible, 'store');

		flash()->success('Pridanie sa podarilo!');
		return redirect()->route('admin.user_list');
	}



	public function edit($id)
	{
		$this->authorize('is-admin');

		$user = User::findOrFail($id);

		return view('auth.edit')
			->with('title', 'Edit user')
			->with('user', $user);
	}



	public function update(Request $request, $id)
	{
		$this->authorize('is-admin');

		$user = User::findOrFail($id);

		$validator = $this->validator($request->all());
		if ($validator->fails()){
			return back()->withErrors($validator)->withInput();
		}

		$password_visible = $request->get('password');

		$user->name = $request->get('name');
		if ($request->get('password')){
			$user->password = bcrypt($password_visible);
		}
		$user->role_id = $request->get('role_id');
		$user->save();

		if ($request->get('password')) {
			$this->html_email($user, $password_visible, 'update');
		}

		flash()->success('Aktualizácia sa podarila!');
		return redirect()->route('admin.user_list');
	}



	public function delete($id)
	{
		$this->authorize('is-admin');

		$user = User::findOrFail($id);

		return view('auth.delete')
			->with('user', $user);
	}



	public function destroy($id)
	{
		$this->authorize('is-admin');

		$user = User::findOrFail($id);

		foreach ($user->posts as $post){
			$post->delete();
		}
		$user->delete();

		flash()->success('Mazanie sa podarilo!');
		return redirect()->route('admin.user_list');
	}



	private function validator(array $data)
	{
		return \Validator::make($data, [
			'name' => 'required|max:255',
			'email' => isset($data['email']) ? 'required|unique:users' : '',
			'password' => 'confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
		]);
	}



	public function user_list()
	{
		$users = USER::all();
		return view('auth.user_list')
			->with('users', $users);
	}



	public function html_email($user, $password_visible, $type) {
		if ($type == 'store'){
			$mail = 'auth.mail_store';
		}
		else if ($type == 'update'){
			$mail = 'auth.mail_update';
		}
		$data = array('name'=>$user->name, 'email' => $user->email, 'password_visible' => $password_visible);
		Mail::send($mail, $data, function($message) use ($user){
			$message->to($user->email, 'Laravel Blog')->subject
			('Laravel Blog');
			$message->from('laravel.blog.nr@gmail.com','Laravel Blog');
		});
	}

}
