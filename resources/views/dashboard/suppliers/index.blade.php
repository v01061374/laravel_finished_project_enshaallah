@extends('dashboard.layouts.master')
@section('title')
    Suppliers
@endsection
@section('body-class')
    hold-transition sidebar-mini
@endsection

    <!-- Content Wrapper. Contains page content -->

        <!-- /.content-header -->
@section('content')
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row mb-5">
                    <a href="{{route('suppliers.create')}}">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable" role="grid">
                            <thead>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Address</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $i => $supplier)
                                    <tr>
                                        <td class="sorting_1">
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            {{$supplier['title']}}
                                        </td>
                                        <td>
                                            {{$supplier['address']}}
                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                {{--link to purchase--}}
                                            <a title="edit" href="{{route('suppliers.edit', ['id' => \App\CustomClasses\Hasher::encode($supplier['id'])])}}"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="{{route('suppliers.delete',\App\CustomClasses\Hasher::encode($supplier['id']))}}"></i>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <div class="modal fade show" id="modal-delete" style="padding-right: 16px;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Notice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete this entry?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button id="delete-no" type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                        <button id="delete-yes" type="button" class="btn btn-outline-light" data-dismiss="modal">yes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.c <tent -->

    <!-- /.content-wrapper -->




@endsection

