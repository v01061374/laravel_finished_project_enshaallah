@extends('dashboard.layouts.master', ['sections' => ['dashboard','Receipts']])
@section('title')
    Receipts
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
                    <a href="{{route('receipts.create')}}">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable receipts-dataTable" role="grid">
                            <thead>
                                <tr>
                                    {{--TODO add individual column search--}}
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Payment Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Payment</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Income</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Side Costs</th>
                                    {{--TODO make uneditable after making automated calculation--}}
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($receipts as $i => $receipt)
                                    <tr>
                                        <td class="sorting_1">
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            {{$receipt['payment_date']}}
                                        </td>
                                        <td>
                                            {{"later"}}
                                            {{--TODO Total payment--}}

                                        </td>
                                        <td>
                                            {{"later"}}
                                            {{--TODO Total income--}}

                                        </td>
                                        <td>
                                            {{$receipt['side_costs']}}
                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                {{--link to receipt--}}
                                            <a title="edit" href="{{route('receipts.edit', ['id' => \App\CustomClasses\Hasher::encode($receipt['id'])])}}"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="{{route('receipts.delete',\App\CustomClasses\Hasher::encode($receipt['id']))}}"></i>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Payment Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Payment</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Income</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Side Costs</th>
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

