@extends('dashboard.layouts.master', ['sections' => ['dashboard','Receipts', isset($receipt)?'Edit':'Create']])
@section('title')
    @if(isset($receipt))
        Receipts - Edit
    @else
        Receipts - Create
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
                        {!! Form::open( ['route' => [isset($receipt)?'receipts.update':'receipts.store', isset($receipt)?$receipt['id']:''], 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('payment_date', 'Payment Date'); !!}
                            {!! Form::date('payment_date',isset($receipt)?$receipt['payment_date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Payment Date' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('rial_comm_offset', 'Commision offset (Rial)'); !!}
                            {!! Form::number('rial_comm_offset',isset($receipt)?$receipt['rial_comm_offset']:'',[ 'class' => 'form-control', 'placeholder' => 'Commision offset (Rial)' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('rial_cost_offset', 'Costs offset (Rial)'); !!}
                            {!! Form::number('rial_cost_offset',isset($receipt)?$receipt['rial_cost_offset']:'',[ 'class' => 'form-control', 'placeholder' => 'Costs offset (Rial)' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('desc', 'Description'); !!}
                            {!! Form::textarea('desc',isset($receipt)?$receipt['desc']:'',[ 'class' => 'form-control', 'placeholder' => 'Description' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('side_costs', 'Side Costs (Rial)'); !!}
                            {!! Form::number('side_costs',isset($receipt)?$receipt['side_costs']:'',[ 'class' => 'form-control', 'placeholder' => 'Side Costs (Rial)', 'min' => 0 ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit(isset($receipt)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
