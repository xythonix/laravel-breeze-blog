@extends('guest.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
@endsection

@section('title')
    Xy - {{$category_name}}
@endsection

@section('header')
    <div class="header flex-column justify-content-center align-items-start" >
        <h1 class="text-4xl font-bold text-white">Category - '{{$category_name}}'</h1>
    </div>
@endsection

@section('body')
<section class="py-6 sm:py-12 dark:bg-gray-800 dark:text-gray-100">
	<div class="container p-6 mx-auto space-y-8">
		<div class="space-y-2 text-center">
			<h2 class="display-3 text-gray-700 font-bold">All Posts</h2>
			<p class="text-sm text-gray-700 mb-2">Check your latest posts here.</p>
		</div>
		<div class="grid grid-cols-1 gap-x-4 gap-y-8 md:grid-cols-2 lg:grid-cols-4">
            {{-- @dd($categories) --}}
			@foreach ($categories as $category)
                @for ($i = 0; $i < count($category->Post); $i++)
                    <article class="flex flex-col shadow-sm bg-white">
                        @if ($category->post[$i]->post_img)
                            <img alt="" class="object-cover border-bottom w-full h-52 dark:bg-gray-500" src="{{asset('storage/images/'.$category->post[$i]->post_img)}}">
                        @else 
                            <div class="w-full border-bottom bg-gray-200 h-52 d-flex justify-content-center align-items-center">
                                <h1 class="text-2xl text-gray-500">No Image</h1>
                            </div>
                        @endif
                        <div class="flex flex-col flex-1 p-6">
                            <h3 class="flex-1 py-2 text-lg font-semibold leadi">
                                <a class="hover:underline" href="{{route('guest.singlePost',$category->post[$i]->id)}}">{{Str::limit($category->post[$i]->title,50)}}</a>
                            </h3>
                            <div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-400">
                                <span class="text-gray-400">
                                    
                                </span>
                                <span class="font-semibold text-gray-500">{{$category->post[$i]->created_at->format('d M Y')}}</span>
                            </div>
                        </div>
                    </article>
                @endfor
                
			@endforeach
			
		</div>
		{{-- <div> {{$categories->links()}} </div> --}}
	</div>
</section>
</section>
@endsection



