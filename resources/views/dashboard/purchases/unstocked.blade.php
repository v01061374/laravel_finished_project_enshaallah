@extends('dashboard.layouts.master', ['sections' => ['dashboard','Purchases', 'unstocked']])
@section('title')
    Unstocked Equipments
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
                <h2>Products</h2>
                <div class="row">
                    <div class="col-sm-12">
                        {{--TODO add table for materials--}}
                        <table class="table table-bordered table-hover dataTable purchases-dataTable" role="grid">
                            <thead>
                                <tr>
                                    {{--TODO add individual column search--}}
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Product Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Quantity</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Purchase Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Specify Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unstockedPurchases['products'] as $i => $unstockedPurchase)
                                    <tr>
                                        <td class="sorting_1">
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            {{$unstockedPurchase['product']['title']}}
                                        </td>
                                        <td>
                                            {{$unstockedPurchase['product']['pivot']['qty']}}
                                        </td>
                                        <td>
                                            {{$unstockedPurchase['date']}}
                                        </td>

                                        <td id="row-actions">
                                            {!! Form::select('stock_id',$stocks,'',['class' => 'form-control select-stock', 'style'=>'float: left; width: auto;']) !!}
                                            <i title="Transfer To Stock" style="float: left;margin-left: 10px; margin-top: 10px; color: green; margin-right: 5px; cursor: pointer;" class="transfer-product fas fa-check" data-action="{{route('purchases.products.specify')}}" data-qty = "{{$unstockedPurchase['product']['pivot']['qty']}}" data-prid="{{\App\CustomClasses\Hasher::encode($unstockedPurchase['product']['id'])}}" data-puid="{{\App\CustomClasses\Hasher::encode($unstockedPurchase['purchase_id'])}}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Product Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Quantity</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Purchase Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Specify Stock</th>
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

