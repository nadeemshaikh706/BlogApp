<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog as BlogPost;


class Blog extends Component
{
    public $blog;

    public function mount($slug){
        $this->blog = BlogPost::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.blog')
                ->extends('layouts.livewire')
                ->section('content');
    }
}
