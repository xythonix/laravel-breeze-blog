<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Post') }}
        </h2>
    </x-slot>

    <style>
        .inp_div
        {
            position: relative;
            width: 100px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border: 1px solid #0099f9;
            border-radius: 10px;
        }
        .inp_div input
        {
            position: absolute;
            left: 0;
            width: 100%;
            z-index: 9;
            height: 200%;
        }
        .inp_div input::-webkit-file-upload-button
        {
            background: #0099f9;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .inp_div span
        {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            color: #fff
        }

        #imagePreview
        {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 350px;
            height: 250px;
            border-radius: 10px;
        }
    </style>

    {{-- INCLUDING LOADING SPINNER --}}
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <form id="add_form" action="{{route('post.add_post')}}" enctype="multipart/form-data" method="POST" class="row">
                    @csrf

                    <div class="col-lg-6 p-3" style="border-right: 1px solid #ddd">
                        <label class="mt-2" for="title">Title</label>
                        <input value="{{old('title')}}" required type="text" placeholder="Post Title" name="title" class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    
                        <label required class="mt-2" for="description">Description</label>
                        <textarea value="{{old('description')}}" placeholder="Post Description" style="resize: none" name="description" id="" class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm tinymce-editor" cols="30" rows="3"></textarea>
                    
                        <label class="mt-2" for="category">Category</label>
                        <select name="category" class="form-control" id="exampleSelect">
                            <option>Select Category</option>
                            
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>

                        <button id="add_btn" class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 px-4 mt-4 rounded">Add Post</button>
                    </div>

                    <div class="col-lg-6 align-self-center justify-content-center align-items-center">
                        <!-- Image element to display the preview -->
                        <img id="imagePreview" class="shadow mx-auto" style="display: none" src="#" alt="Image Preview">
                    
                        <div class="inp_div shadow mx-auto">
                            <input type="file" name="image" id="imageInput">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    document.getElementById('imagePreview').src = reader.result;
                    document.getElementById('imagePreview').style.marginBottom = '20px';
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('add_form').addEventListener('submit',function(e){
            document.querySelector('.outer_spinner').style.display = 'block';
        })
    </script>
    

</x-app-layout>
