@extends('dashboard.layouts.master', ['sections' => ['dashboard','Suppliers', isset($supplier)?'Edit':'Create']])
@section('title')
    @if(isset($supplier))
        Suppliers - Edit
    @else
        Suppliers - Create
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
                        {!! Form::open(['route' => [isset($supplier)?'suppliers.update':'suppliers.store', isset($supplier)?$supplier['id']:'']]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($supplier)?$supplier['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address'); !!}
                            {!! Form::textarea('address',isset($supplier)?$supplier['address']:'', ['class' => 'form-control', 'placeholder' => 'Address']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($supplier)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
