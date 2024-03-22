<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> Mikman</title>
    <!-- CSS files -->
    <link href="{{ asset('mikman') }}/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="{{ asset('mikman') }}/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.46.0/apexcharts.min.css">
    
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
            @include('admin.layouts.header')
        </header>
        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                @include('admin.layouts.menu')
            </div>
        </header>
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <!-- Page body -->
                        @yield('body')
                        @include('admin.layouts.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    @include('admin.layouts.script')
    @include('sweetalert::alert')

</body>

</html>
