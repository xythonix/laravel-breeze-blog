<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-lg-3 p-2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row p-2">
                    @if ($posts->count() > 0)
                        <table class="table table-bordered table-striped" style="word-wrap: break-word;">
                            <tbody>
                                <tr>
                                    <td class="font-bold">No.</td>
                                    <td class="font-bold">Thumbnail</td>
                                    <td class="font-bold">Title</td>
                                    <td class="font-bold">Posted on</td>
                                    <td class="font-bold">Category</td>
                                    <td class="font-bold">Options</td>
                                </tr>

                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            @if ($post->post_img)
                                                <img src="{{asset('storage/images/'.$post->post_img)}}" style="width: 50px;height:50px;border-radius:5px;border:1px solid #a3a3a3;" alt="">
                                            @else
                                                <p class="text-gray-500">No Image</p>
                                            @endif
                                        </td>
                                        <td class="text-gray-500">{{Str::limit($post->title,100)}}</td>
                                        <td class="text-gray-500">{{$post->created_at->format('d F Y')}}</td>
                                        <td class="text-gray-500">{{$post->Category->name}}</td>
                                        <td>
                                            <a href="{{route('view.single',$post->id)}}" class="btn btn-sm btn-warning" title="Preview"><i class="fas fa-folder text-white"></i></a>
                                            <a href="{{route('view.update_post',[$post->id,$post->cat_id])}}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pen"></i></a>
                                            <a href="{{route('view.del_post',[$post->id, $post->cat_id])}}" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>  
                                    </tr>

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div>
                            {{ $posts->links() }}
                        </div>
                    @else 
                        <h1 class="p-2 text-gray-5">No Posts!</h1>
                    @endif
                </div>            
            </div>
        </div>
    </div>

</x-app-layout>
