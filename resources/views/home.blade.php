@extends('layouts.livewire')

@section('content')

    <div class="container mx-auto p-5">
        <a class="inline-flex justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 cursor-pointer" href="{{ route('blog.create') }}">Create Blog</a>
        <h1 class="text-4xl mt-32 text-center tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
            Welcome to The BlogAPP
        </h1>
        <div class="mt-10 max-w-xl mx-auto">
            @if(auth()->user())
                <!-- Display all blog to loggedin user -->
                @foreach(\App\Models\Blog::all() as $blog)
                    <div class="border-b mb-5 pb-5 border-gray-200">
                        <a href="/blog/{{ $blog->slug }}" class="text-2xl font-bold mb-2">{{ $blog->title }}</a>
                            @if(auth()->user())
                                @if(auth()->user()->id == $blog->user_id)
                                    <a class="pl-5 float-right" href="{{route('blog.edit',$blog->slug)}}">Edit</a>
                                    
                                @endif    
                            @endif    
                        <p>{{ Str::limit($blog->body, 100) }}</p>
                    </div>
                @endforeach
            @else
                <!-- Display only active blog to not loggedin user -->
                @foreach(\App\Models\Blog::where('active','1')->get() as $blog)
                    <div class="border-b mb-5 pb-5 border-gray-200">
                        <a href="/blog/{{ $blog->slug }}" class="text-2xl font-bold mb-2">{{ $blog->title }}</a>
                            @if(auth()->user())
                                @if(auth()->user()->id == $blog->user_id)
                                    <a class="pl-5 float-right" href="{{route('blog.edit',$blog->slug)}}">Edit</a>
                                    
                                @endif    
                            @endif    
                        <p>{{ Str::limit($blog->body, 100) }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection
