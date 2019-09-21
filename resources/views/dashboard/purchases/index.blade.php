@extends('dashboard.layouts.master', ['sections' => ['dashboard','Purchases']])
@section('title')
    Purchases
@endsection
@section('body-class')
    hold-transition layout-fixed sidebar-mini
@endsection

    <!-- Content Wrapper. Contains page content -->

        <!-- /.content-header -->
@section('content')
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-5">
                    <a href="{{route('purchases.create')}}">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable purchases-dataTable" role="grid">
                            <thead>
                                <tr>
                                    {{--TODO add individual column search--}}
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Supplier</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Side Costs</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Cost</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $i => $purchase)
                                    <tr>
                                        <td class="sorting_1">
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            {{$purchase['date']}}
                                        </td>
                                        <td>
                                            {{$purchase['supplier']['title']}}
                                        </td>
                                        <td>
                                            {{$purchase['side_costs']}}
                                        </td>
                                        <td>
                                            {{"later!!"}}
                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                {{--link to purchase--}}
                                            <a title="edit" href="{{route('purchases.edit', ['id' => \App\CustomClasses\Hasher::encode($purchase['id'])])}}"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="{{route('purchases.delete',\App\CustomClasses\Hasher::encode($purchase['id']))}}"></i>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Supplier</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Side Costs</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Cost</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.c <tent -->

    <!-- /.content-wrapper -->
@endsection

