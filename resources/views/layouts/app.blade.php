<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title', 'Home')</title>

    <!-- Google Font Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Style CSS -->
    <link href="{{ secure_asset('assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ secure_asset('assets/css/custom-style.css') }}" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Vendor -->
    <link href="{{ secure_asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('vendors/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('vendors/leaflet.markercluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('vendors/leaflet.markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ secure_asset('assets/js/config.js') }}"></script>
    <script src="{{ secure_asset('vendors/simplebar/simplebar.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

</head>
<body>
    @yield('content')


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ secure_asset('vendors/popper/popper.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/anchorjs/anchor.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/is/is.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/lodash/lodash.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/list.js/list.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/dayjs/dayjs.min.js')}}"></script>
    <script src="{{ secure_asset('vendors/leaflet/leaflet.js')}}"></script>
    <script src="{{ secure_asset('vendors/leaflet.markercluster/leaflet.markercluster.js')}}"></script>
    <script src="{{ secure_asset('vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js')}}"></script>
    <script src="{{ secure_asset('assets/js/phoenix.js')}}"></script>
    <script src="{{ secure_asset('vendors/echarts/echarts.min.js')}}"></script>
    <script src="{{ secure_asset('assets/js/dashboards/ecommerce-dashboard.js')}}"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script type="module" src="{{ secure_asset('assets/js/modules/renderer.js')}}"></script>

    <script>
        NProgress.start();

        // Selesai saat semua konten (termasuk gambar) sudah dimuat
        window.addEventListener('load', function () {
            NProgress.done();
        });
    </script>
</body>
</html>
