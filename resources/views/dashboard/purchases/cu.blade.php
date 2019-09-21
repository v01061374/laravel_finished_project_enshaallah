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
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                        {!! Form::open( ['route' => [isset($purchase)?'purchases.update':'purchases.store', isset($purchase)?$purchase['id']:''], 'files' => true]) !!}
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
                            {!! Form::select('supplier_id',$suppliers,isset($purchase)?$purchase['supplier_id']:'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit(isset($purchase)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
