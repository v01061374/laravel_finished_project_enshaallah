@extends('dashboard.layouts.master', ['sections' => ['dashboard','Packages', isset($package)?'Edit':'Create']])
@section('title')
    @if(isset($package))
        Packages - Edit
    @else
        Packages - Create
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
                        {!! Form::open( ['route' => [isset($package)?'packages.update':'packages.store', isset($package)?$package['id']:''], 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('acceptance_date', 'Acceptance Date'); !!}
                            {!! Form::date('acceptance_date',isset($package)?$package['acceptance_date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Acceptance Date' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('expectation_date', 'Expectation Date'); !!}
                            {!! Form::date('expectation_date',isset($package)?$package['expectation_date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Expectation Date' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('package_number', 'Package Number'); !!}
                            {!! Form::number('package_number',isset($package)?$package['package_number']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Package Number' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('stock_id', 'Digi Stock'); !!}
                            {!! Form::select('stock_id',$digiStocks,isset($package)?$package['stock_id']:'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('elapsed_time', 'Elapsed Time (min)'); !!}
                            {!! Form::number('elapsed_time',isset($package)?$package['elapsed_time']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Elapsed Time (min)' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cost', 'Cost (rial)'); !!}
                            {!! Form::number('cost',isset($package)?$package['cost']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Cost (rial)' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($package)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
