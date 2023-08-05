@extends('guest.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
@endsection

@section('title')
    Xy - {{$search_val}}
@endsection

@section('header')
    <div class="header">
        <h1 class="text-4xl font-bold text-white">Search for '{{$search_val}}'</h1>
    </div>
@endsection

@section('body')
    <section class="py-6 sm:py-12 dark:bg-gray-800 dark:text-gray-100">
	<div class="container p-6 mx-auto space-y-8">	
			@if ($posts->count() > 0)
            <div class="grid grid-cols-1 gap-x-4 gap-y-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($posts as $post)
                        <article class="flex flex-col shadow-sm bg-white">
                            @if ($post->post_img)
                                <img alt="" class="object-cover border-bottom w-full h-52 dark:bg-gray-500" src="{{asset('storage/images/'.$post->post_img)}}">
                            @else 
                                <div class="w-full border-bottom bg-gray-200 h-52 d-flex justify-content-center align-items-center">
                                    <h1 class="text-2xl text-gray-500">No Image</h1>
                                </div>
                            @endif
                            <div class="flex flex-col flex-1 p-6">
                                <a href="{{route('guest.category', $post->Category->id)}}" class="text-xs tracki uppercase hover:underline text-info">{{$post->Category->name}}</a>
                                <h3 class="flex-1 py-2 text-lg font-semibold leadi">
                                    <a class="hover:underline" href="{{route('guest.singlePost',$post->id)}}">{{Str::limit($post->title,50)}}</a>
                                </h3>
                                <div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-400">
                                    <span class="text-gray-400">
                                        by <a href="{{route('guest.author',$post->Author->id)}}" class="text-info font-semibold text-[.95rem]">{{$post->Author->name}}</a>
                                    </span>
                                    <span class="font-semibold text-gray-500">{{$post->created_at->format('d M Y')}}</span>
                                </div>
                            </div>
                        </article>
                @endforeach
            </div>
            @else
            <div class="space-y-2 text-center">
                <h2 class="display-3 text-gray-700 font-bold">Sorry!</h2>
            </div>
            @endif
			
		
		<div> {{$posts->links()}} </div>
	</div>
</section>
@endsection



