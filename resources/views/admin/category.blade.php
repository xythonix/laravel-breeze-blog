<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-3 overflow-hidden shadow-sm sm:rounded-lg">
                <p class="text-grey-600 text-lg mb-3">Add Category</p>
                
                {{-- FIRST ROW --}}
                <form action="{{route('post.category')}}" method="POST" id="category_form" class="row mb-4">
                    @csrf
                    <div class="col-lg-3 col-8">
                        <input name="category" required placeholder="Category name" type="text" class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>
                    <div class="col-lg-3 col-4">
                        <button id="add_btn" class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Add</button>
                    </div>
                </form>

                {{-- SECOND ROW --}}
                <hr>
                @if ($categories->count() > 0)
                    <p class="text-grey-600 text-lg mb-3 mt-3">All Categories</p>

                    <div class="row justify-content-center">
                        <div class="col">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>No.</b></td>
                                        <td><b>Name</b></td>
                                        <td><b>No. of posts</b></td>
                                        <td><b>Delete</b></td>
                                    </tr>

                                    @php
                                        $increment = 1;
                                    @endphp

                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$increment}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->post_count}}</td>
                                            <td>
                                                <a id="del_button" class="btn btn-sm btn-danger shadow" href="{{route('view.del_category', $category->id)}}">Remove</a>
                                            </td>
                                        </tr>

                                        @php
                                            $increment++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @else 
                    <p class="text-grey-600 text-lg mb-3 mt-3">No Category!</p>

                @endif
            </div>
        </div>
    </div>

    <script>
        var del_btn = document.getElementById('del_button')
        var add_btn = document.getElementById('add_btn')

        add_btn.addEventListener('click', function(){
            add_btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>'
        })        

        del_btn.addEventListener('click', function(){
            del_btn.style.display = 'none'
        })
    </script>

</x-app-layout>
