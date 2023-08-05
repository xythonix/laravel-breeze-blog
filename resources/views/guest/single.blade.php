@extends('guest.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
@endsection

@section('title')
    Xy - {{$post->title}}
@endsection

@section('header')
    <div class="header flex-column justify-content-center align-items-start" >
        <h1 class="text-4xl font-bold text-white">{{Str::limit($post->title,70)}}</h1>
        <p class="lead mt-2 text-white">by 
            <a href="" class="underline">{{$post->Author->name}}</a>
        </p>
    </div>
@endsection

@section('body')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if ($post->post_img)
                    <img src="{{asset('storage/images/'.$post->post_img)}}" alt="" class="object-fit w-full h-90 rounded-md">
                @else
                    <div class="w-full bg-gray-200 h-60 d-flex justify-content-center align-items-center">
                        <h1 class="text-2xl text-gray-500">No Image</h1>
                    </div>
                @endif
                <br>
                <p class="lead text-gray-800">{!! $post->description !!}</p>
                <br>
                <small class="text-info text-lg hover:underline">
                    <a href="{{route('guest.category',$post->Category->id)}}">{{$post->Category->name}}</a>
                </small>
                <br>
            </div>
        </div>
    </div>
</section>
@endsection



