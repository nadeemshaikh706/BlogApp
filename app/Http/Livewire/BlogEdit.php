<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog as BlogPost;
use Illuminate\Support\Str;

class BlogEdit extends Component
{
    public $blog;
    public $saveSuccess = false;
    public $error = false;
    /*
    * Validator rules
    */
    protected $rules = [
        'blog.title' => 'required|min:6',
        'blog.body' => 'required|min:6',
        'blog.active'=>'required'
    ];

    public function mount($slug){
        $this->blog = BlogPost::where('slug', $slug)->first();
    }

    public function update()
    {
        if($this->blog->user_id != auth()->user()->id){
            $this->error = true;
            return;
        }
        //to validate form
        $this->validate();
        
        //Create blog
        $this->blog->active = $this->blog->active;
        $this->blog->slug = Str::slug($this->blog->title);
		$this->blog->title = $this->blog->title;
        $this->blog->body = $this->blog->body;
        $this->blog->save();
        $this->saveSuccess = true;
    }
    public function render()
    {
        return view('livewire.blog-edit')
        ->extends('layouts.livewire')
        ->section('content');
    }
}
