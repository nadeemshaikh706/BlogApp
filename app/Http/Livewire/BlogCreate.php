<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Blog;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;

class BlogCreate extends Component
{
    public $saveSuccess = false;
    public $blog;

    /*
    * Validator rules
    */
    protected $rules = [
        'blog.title' => 'required|min:6',
        'blog.body' => 'required|min:6',
        'blog.active'=>'required'
    ];

    public function mount(){
        $this->blog = new Blog;
    }

    /*
    * to create Blog
    */
    public function saveBlog(){
        //to validate form
        $this->validate();
        
        //Create blog
        $this->blog = Blog::create([
			'active' => $this->blog->active,
			'slug' => Str::slug($this->blog->title),
			'title' => $this->blog->title,
            'body' => $this->blog->body,
            'user_id' => auth()->user()->id
        ]);
        $this->saveSuccess = true;
    }

    /*
    * render view
    */
    public function render()
    {
        return view('livewire.blog-create')
            ->extends('layouts.livewire')
            ->section('content');
    }
}
