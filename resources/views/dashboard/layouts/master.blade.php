<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('resources/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('resources/dist/css/adminlte.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('resources/assets/css/styles.css')}}">




</head>
<body class="@yield('body-class')">
<div class="wrapper">
    @include('dashboard.parts.main-navbar')
    @include('dashboard.parts.main-sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @foreach(explode('/',request()->path()) as $i => $section)
                                <li class="breadcrumb-item {{ ($i==count(explode('/',request()->path()))-1)? "active": ""}}">
                                    @if($i==count(explode('/',request()->path()))-1)
                                        {{ucfirst($section)}}
                                    @else
                                        <a href="/{{$section}}">{{ucfirst($section)}}</a>
                                    @endif
                                </li>
                                {{--{{ ($i==count(explode('/',request()->path()))-1)? "":"/"}}--}}
                            @endforeach
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @yield('content')
    </div>
    @include('dashboard.parts.control-sidebar')
    @include('dashboard.parts.main-footer')
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('resources/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('resources/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('resources/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('resources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('resources/dist/js/adminlte.min.js')}}"></script>
<script>



    $(document).ready(function() {
        $(".dataTable").dataTable({

        });
        var set_action = function (clicked) {
            window.ajax_action=clicked.getAttribute('data-action');
        };
        $('.row-delete').on('click', function(){
            $this = this;
            $.when(set_action($this)).done(function () {
                $('#delete-yes').on('click', function () {

                    return new Promise((resolve, reject)=> {
                        $.ajax({
                            url: window.ajax_action,
                            type: 'get',
                            success: function() {
                                location.reload();
                                resolve()
                            },
                            error: function(error) {
                                reject(error)
                            },
                        })
                    })
                })
            })
        })
    });

</script>
</body>
</html>
