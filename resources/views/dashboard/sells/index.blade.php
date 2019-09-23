@extends('dashboard.layouts.master', ['sections' => ['dashboard','Sells']])
@section('title')
    Sells
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
                    <a href="{{route('sells.create')}}">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable sells-dataTable" role="grid">
                            <thead>
                                <tr>
                                    {{--TODO add links to related entities everywhere--}}
                                    {{--TODO add individual column search--}}
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Product</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Order Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Final Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Unit Price</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Quantity</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Status</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sells as $i => $sell)
                                    <tr>
                                        <td class="sorting_1">
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            {{$sell['product']['title']}}
                                        </td>
                                        <td>
                                            {{$sell['order_date']}}
                                        </td>
                                        <td>
                                            {{$sell['final_date']}}
                                        </td>
                                        <td>
                                            {{$sell['unit_price']}}
                                        </td>
                                        <td>
                                            {{$sell['qty']}}
                                        </td>
                                        <td>
                                            @if($sell['is_returned'])
                                                Returned
                                            @elseif($sell['is_final'])
                                                Final
                                            @else
                                                Pending
                                            @endif
                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                {{--link to purchase--}}
                                            <a title="edit" href="{{route('sells.edit', ['id' => \App\CustomClasses\Hasher::encode($sell['id'])])}}"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="{{route('sells.delete',\App\CustomClasses\Hasher::encode($sell['id']))}}"></i>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Product</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Order Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Final Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Unit Price</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Quantity</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Status</th>
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

