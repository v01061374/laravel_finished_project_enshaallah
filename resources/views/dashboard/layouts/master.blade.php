<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('resources/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                            @foreach($sections as $i => $section)
                                <li class="breadcrumb-item {{ ($i==count($sections)-1)? "active": ""}}">
                                    @if($i==0)
                                        <a href="/{{$section}}">{{ucfirst($section)}}</a>
                                    @elseif($i==count($sections)-1)
                                        {{ucfirst($section)}}
                                    @else
                                        <a href="/dashboard/{{lcfirst($section)}}">{{$section}}</a>
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
        @include('dashboard.parts.delete-modal')
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
<script src="{{asset('resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('resources/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('resources/dist/js/adminlte.min.js')}}"></script>
<script>



    $(document).ready(function() {
        $(".suppliers-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2,3]}
            ]
        });
        $(".sizes-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[5]}
            ]
        });
        $(".weights-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3]}
            ]
        });
        $(".productCategories-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3]}
            ]
        });
        $(".materialCategories-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".tools-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".products-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3,4]}
            ]
        });
        $(".materials-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3]}
            ]
        });
        $(".stocks-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".purchases-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[4]}
            ]
        });
        $(".receipts-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[5]}
            ]
        });
        $(".sells-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[5]}
            ]
        });
        $(".digiStocks-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".packages-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".configs-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
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

        $('.transfer-product').on('click', function(){
            $this = this;
            var stock_id = $(this).siblings('.select-stock').val();
            var prod_id = $(this).data('prid');
            var qty = $(this).data('qty');
            var pu_id = $(this).data('puid');
            $.when(set_action($this)).done(function () {
                return new Promise((resolve, reject)=> {
                    $.ajax({
                        url: window.ajax_action,
                        type: 'post',
                        data: {
                            'pr_id': prod_id,
                            'st_id': stock_id,
                            'pu_id': pu_id,
                            'qty' : qty,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(e) {
                            e.preventDefault();
                            resolve()
                        },
                        error: function(error) {
                            reject(error)
                        },
                    })
                })
            })
        })

    });

</script>
    @yield('scripts')
</body>
</html>
