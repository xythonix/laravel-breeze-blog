<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @yield('css')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: #f7f7f7
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    @include('guest.navbar')

    {{-- HEADER SECTION --}}
    @yield('header')

    {{-- BODY SECTION --}}
    @yield('body')

    {{-- FOOTER --}}
    <div id="footer" class="container-fluid" style="background: #3a3a3a;margin-top:150px !important;">
        <div class="row p-lg-4 p-2 justify-content-around">
            <div class="col-lg-5">
                <h2 class="text-xl text-white">Copyright &copy; Xythonix 2023</h2>
            </div>
            <div class="col-lg-5">
                <ul>
                    <li><span class="text-2xl font-semibold text-white mb-2">Categories</span></li>
                    <br>
                    <li><a class="text-white hover:underline" href="">Design</a></li>
                    <li><a class="text-white hover:underline" href="">Professional</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- INCLUDING LOADING SPINNER --}}
    @include('components.spinner')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>