<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>@yield('title')</title>
    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dropify/dist/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/summernote-lite.min.css') }}">

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('js/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('js/highcharts.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                searching: true,
                pageLength: 200,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol']],
                    ['table', ['table', 'hr']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen']]
                ]
            });
        });
    </script>
</head>

<body class="sb-nav-fixed bg-secondary bg-opacity-25">
<div>
    @include('admin.app.navbar')
</div>
<div id="layoutSidenav" style="display: block!important;">
    <div>
        @include('admin.app.sidebar')
    </div>
    <div id="layoutSidenav_content" style="display: block;">
        @include('admin.app.alert')
        @yield('content')
    </div>
</div>
</body>

</html>