<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Post') }}
        </h2>
    </x-slot>

    <style>
        .img_div 
        {
            position: relative;
            width: 100%;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .img_div img 
        {
            position: absolute;
            margin: auto
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-lg-3 p-2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="heading_div text-center mt-2 p-3">
                    <h1 class="text-4xl font-bold">{{$post->title}}</h1>          
                    <p class="text-blue-500 mt-3 mb-3">{{$post->Category->name}}</p>
                </div>
                <br>
                @if ($post->post_img)
                    <div class="img_div">
                        <img src="{{asset('storage/images/'.$post->post_img)}}" alt="">
                    </div>
                    <br>
                @endif
                <p class="m-lg-3 m-2 text-xl text-gray-900" >{!! $post->description !!}</p>
                <p class="m-lg-3 m-2 text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                <br>
            </div>
        </div>
    </div>

</x-app-layout>
