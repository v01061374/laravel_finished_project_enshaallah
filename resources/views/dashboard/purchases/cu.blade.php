@extends('dashboard.layouts.master', ['sections' => ['dashboard','Purchases', isset($purchase)?'Edit':'Create']])
@section('title')
    @if(isset($purchase))
        Purchases - Edit
    @else
        Purchases - Create
    @endif
@endsection
@section('body-class')
    hold-transition layout-fixed sidebar-mini
@endsection

@section('content')
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    </div>
                    <div class="row">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if(session()->has('no-change'))
                            <div class="alert alert-danger">
                                {{ session()->get('no-change') }}
                            </div>
                        @endif

                    </div>
                    <div class="row">

                        {!! Form::open( ['route' => [isset($purchase)?'purchases.update':'purchases.store', isset($purchase)?$p_id:''], 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('', 'Products'); !!}
                            <div id="inline-products">
                                <table id="inline-products-table">
                                    <tbody>
                                    {{--TODO disable selected products in next dropdown--}}
                                            @if(isset($purchase) && count($purchase['products']))
                                                @foreach($purchase['products'] as $product)
                                                    <tr class="inline-product-record">

                                                        @if(1==0 && $product['pivot']['stocked'])
                                                            {{--TODO resolve + button problem--}}
                                                            <td>
                                                                {!! Form::select('product_id[]',$products,\App\CustomClasses\Hasher::encode($product['id']),['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title', 'disabled' => "true"]) !!}
                                                            </td>
                                                            <td>
                                                                {!! Form::number('qty[]',$product->pivot->qty,[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' , 'disabled' => "true"]) !!}
                                                            </td>
                                                            <td>
                                                                {!! Form::number('price[]',$product->pivot->unit_price,[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' , 'disabled' => "true"]) !!}
                                                            </td>
                                                        @else
                                                            <td>
                                                                {!! Form::select('product_id[]',$products,\App\CustomClasses\Hasher::encode($product['id']),['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title']) !!}
                                                            </td>
                                                            <td>
                                                                {!! Form::number('qty[]',$product->pivot->qty,[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' ]) !!}
                                                            </td>
                                                            <td>
                                                                {!! Form::number('price[]',$product->pivot->unit_price,[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' ]) !!}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <i title="Add New" class="inline-product-add fas fa-plus-circle" style="color:green; margin-left: 5px; cursor: pointer;"></i>
                                                        </td>
                                                        <td>
                                                            <i title="Remove" class="inline-product-remove fas fa-times-circle" style="color:red; margin-left: 5px; cursor: pointer;"></i>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @elseif(isset($purchase) && !count($purchase['products']))
                                                <tr class="inline-product-record">

                                                    <td>
                                                    {!! Form::select('product_id[]',$products,'',['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::number('qty[]','',[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' ]) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::number('price[]','',[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' ]) !!}
                                                    </td>
                                                    <td>
                                                        <i title="Add New" class="inline-product-add fas fa-plus-circle" style="color:green; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                    <td>
                                                        <i title="Remove" class="inline-product-remove fas fa-times-circle" style="color:red; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="inline-product-record">
                                                    <td>
                                                    {!! Form::select('product_id[]',$products,'',['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::number('qty[]','',[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' ]) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::number('price[]','',[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' ]) !!}
                                                    </td>
                                                    <td>
                                                        <i title="Add New" class="inline-product-add fas fa-plus-circle" style="color:green; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                    <td>
                                                        <i title="Remove" class="inline-product-remove fas fa-times-circle" style="color:red; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                </tr>
                                            @endif

                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('date', 'Date'); !!}
                            {!! Form::date('date',isset($purchase)?$purchase['date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'date' ]) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('side_costs', 'Side Costs (Rial)'); !!}
                            {!! Form::number('side_costs',isset($purchase)?$purchase['side_costs']:'',[ 'class' => 'form-control', 'placeholder' => 'Side Costs (Rial)', 'min' => 0 ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('supplier_id', 'Supplier'); !!}
                            {!! Form::select('supplier_id',$suppliers,isset($purchase)?\App\CustomClasses\Hasher::encode($purchase['supplier_id']):'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>


                        <div class="form-group">
                            {!! Form::submit(isset($purchase)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {{Form::close()}}
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
@section('scripts')
    <script>
        var wrapper = $('#inline-products-table');
        var recordHtml = $('.inline-product-record').get(0).outerHTML;
        $(document).ready(function () {
            $(document).on('click','.inline-product-add',function () {
                wrapper.append(recordHtml);

                // TODO change css of remaining remove button
            });
            $(document).on('click', '.inline-product-remove', function () {
                if($('.inline-product-record').length-1){
                    this.closest('.inline-product-record').remove();
                }
            })
            $('.select2').select2({

            })
        });
    </script>
@endsection
