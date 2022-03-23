<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_csrf_token" content="{{ csrf_field() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">


    <title>@yield('title', env('APP_NAME'))</title>



    {{-- style --}}

   <!-- FontAwesome JS-->
   <script defer src="{{ asset('dashbaord_files/js/all.min.js') }}"></script>
   {{-- <script defer src="{{ asset('dashbaord_files/css/all.min.css') }}"></script> --}}


   <!-- App CSS -->
   <link id="theme-style" rel="stylesheet" href="{{ asset('dashbaord_files/css/portal.css') }}">
   <link id="theme-style" rel="stylesheet" href="{{ asset('dashbaord_files/css/bootstrap.min.css') }}">

   <link id="theme-style" rel="stylesheet" href="{{ asset('dashbaord_files/css/custom.css') }}">

@if (LaravelLocalization::getCurrentLocale() =='ar')
    <style>
        *{
            direction: rtl;
            font-family: "Droid Sans", sans-serif/*rtl:prepend:"Droid Arabic Kufi",*/;
            font-size:16px/*rtl:14px*/;
        }
        .app-branding{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>


@endif
<style>
    a , button , label{
        cursor: pointer;
    }
</style>

</head>

<body >



    <div class="app">
        <header class="app-header fixed-top">

            @include('admin.layouts.partials._navbar')
            @include('admin.layouts.partials._sidebar')

        </header>


        <div class="app-wrapper">

            <div class="app-content">



                @include('admin.layouts.partials._info')

                <main class="content">

                    @yield('content')

                </main>

            </div>

        </div>

        @include('admin.layouts.partials._footer')



    </div>











</body>








  {{-- <!-- Javascript -->           --}}
  <script src="{{ asset('dashbaord_files/js/popper.min.js') }}"></script>
  <script src="{{ asset('dashbaord_files/js/bootstrap.min.js') }}"></script>


  <!-- Page Specific JS -->
  <script src="{{ asset('dashbaord_files/js/app.js') }}"></script>



@stack('script')

</html>
