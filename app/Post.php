<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'text', 'slug'];

	public function getCreatedAtAttribute($value){
		return date('j M Y, G:i', strtotime($value));
	}

	public function getDatetimeAttribute(){
		return date('Y-m-d', strtotime($this->created_at));
	}

	public function getTeaserAttribute(){
		return word_limiter($this->text, 60);
	}

	public function getRichTextAttribute(){
		return add_paragraphs( filter_url( e($this->text) ) );
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

	public function setTitleAttribute($value){
		$this->attributes['title'] = $value;
		$this->attributes['slug'] = str_slug($value);
	}


}
