<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL('css/mainLayout.css')}}">
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ URL('img/KaiIcon.png') }}">

</head>
<body>
    <div class="wrapper">
        <!-- sidebar -->
        @include('layout.sidebar')
        <div class="main">
            <nav class="navbar navbar-expand-sm atas">
                <div class="container-fluid">
                    <button class="navbar-brand" id="button-navbar">
                        <svg id="hamburger-logo" width="34" height="34" viewBox="0 0 48 48" fill="currentColor" x="128" y="128" role="img" style="display:inline-block;vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M7.95 11.95h32m-32 12h32m-32 12h32"/></g></svg>
                    </button>


                    <!-- Profile Section -->
                    <div class="profile">
                        <div class="ml-auto d-flex align-items-center user">
                            <img src="{{ URL('img/avatar.png') }}" width="30" height="30" class="me-2" alt="Avatar">
                            <p class="namaUser">Admin TI</p>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script src="{{ asset('js/mainJS.js') }}"></script>
    @yield('javascript')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.2/dist/sweetalert2.all.min.js"></script>

        @if(Session::has("Fail"))
        <script>
            Swal.fire("Gagal", "{!! Session::get('Fail') !!}", "error", {
                button: "OK",
            });

        </script>
    @endif
    @if(Session::has("success"))
        <script>
            Swal.fire("Selamat", "{!! Session::get('success') !!}", "success", {
                button: "OK",
            });

        </script>
    @endif

</body>
</html>
