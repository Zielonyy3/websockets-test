<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>

<body id="page-top">
<div id="wrapper">
    @include('layouts.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('layouts.topbar')

            <div class="container-fluid ">
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
        @include('layouts.footer')
    </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('layouts.default_modals')
@yield('modals')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>

<script src="{{asset('js/sb-admin-2.js')}}"></script>

@yield('scripts')

</body>

</html>
