@extends('dashboard.layouts.master', ['sections' => ['dashboard','Sells', isset($sell)?'Edit':'Create']])
@section('title')
    @if(isset($sell))
        Sells - Edit
    @else
        Sells - Create
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
                        {{--TODO make all error reports like this--}}
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
                        {!! Form::open( ['route' => [isset($sell)?'sells.update':'sells.store', isset($sell)?$sell['id']:''], 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('prod_id', 'Product'); !!}
                            {{--TODO add placeholder to all selectboxes--}}
                            {!! Form::select('prod_id',$products,isset($sell)?\App\CustomClasses\Hasher::encode($sell['prod_id']):'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Pick a product...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('order_date', 'Order Date'); !!}
                            {!! Form::date('order_date',isset($sell)?$sell['order_date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Order Date' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('final_date', 'Final Date'); !!}
                            {!! Form::date('final_date',isset($sell)?$sell['final_date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Order Date' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('receipt_id', 'Payment Receipt'); !!}
                            {!! Form::select('receipt_id',$receipts,isset($sell)?\App\CustomClasses\Hasher::encode($sell['receipt_id']):'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Select Related Receipt...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('unit_price', 'Unit Price (Rial)'); !!}
                            {!! Form::number('unit_price',isset($sell)?$sell['unit_price']:'',['required'=>'required', 'class' => 'form-control', 'min' => 0]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('order_number', 'Order Number'); !!}
                            {!! Form::number('order_number',isset($sell)?$sell['order_number']:'',['required'=>'required', 'class' => 'form-control', 'min' => 0]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('qty', 'Quantity'); !!}
                            {!! Form::number('qty',isset($sell)?$sell['qty']:'',['required'=>'required', 'class' => 'form-control', 'min' => 1]) !!}
                        </div>
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('is_final', 'Is Final?') !!}--}}
                            {{--{!! Form::radio('is_final', 'true' , $sell['is_final'] ?? true, ['class' => 'form-control']) !!}--}}
                            {{--{!! Form::radio('is_final', 'false' , $sell['is_final'] ?? false, ['class' => 'form-control']) !!}--}}
                        {{--</div>--}}
                        <div class="form-group">
                            {!! Form::label('', 'Is Final') !!}
                            @if(isset($sell)&&$sell['is_final'])
                            <div class="form-check">
                                {!! Form::radio('is_final', "1" , true, ['class' => 'form-check-input']) !!}
                                {!! Form::label('is_final', 'Yes', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check">
                                {!! Form::radio('is_final', "0" , false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('is_final', 'No', ['class' => 'form-check-label']) !!}
                            </div>
                            @else
                                <div class="form-check">
                                    {!! Form::radio('is_final', "1" , false, ['class' => 'form-check-input']) !!}
                                    {!! Form::label('is_final', 'Yes', ['class' => 'form-check-label']) !!}
                                </div>
                                <div class="form-check">
                                    {!! Form::radio('is_final', "0" , true, ['class' => 'form-check-input']) !!}
                                    {!! Form::label('is_final', 'No', ['class' => 'form-check-label']) !!}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('', 'Is Returned') !!}
                            @if(isset($sell)&&$sell['is_returned'])
                                <div class="form-check">
                                    {!! Form::radio('is_returned', "1" , true, ['class' => 'form-check-input']) !!}
                                    {!! Form::label('is_returned', 'Yes', ['class' => 'form-check-label']) !!}
                                </div>
                                <div class="form-check">
                                    {!! Form::radio('is_returned', "0" , false, ['class' => 'form-check-input']) !!}
                                    {!! Form::label('is_returned', 'No', ['class' => 'form-check-label']) !!}
                                </div>
                            @else
                                <div class="form-check">
                                    {!! Form::radio('is_returned', "1" , false, ['class' => 'form-check-input']) !!}
                                    {!! Form::label('is_returned', 'Yes', ['class' => 'form-check-label']) !!}
                                </div>
                                <div class="form-check">
                                    {!! Form::radio('is_returned', "0" , true, ['class' => 'form-check-input']) !!}
                                    {!! Form::label('is_returned', 'No', ['class' => 'form-check-label']) !!}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($sell)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
