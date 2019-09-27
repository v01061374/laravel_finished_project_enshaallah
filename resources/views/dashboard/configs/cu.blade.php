@extends('dashboard.layouts.master', ['sections' => ['dashboard','Configs', isset($config)?'Edit':'Create']])
@section('title')
    @if(isset($config))
        Configs - Edit
    @else
        Configs - Create
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
                        {!! Form::open(['method' => 'POST','route' => [isset($config)?'configs.update':'configs.store', $config['id'] ?? '']]) !!}
                        {{--TODO form model binding to prevent duplicate database call in controller--}}
                        <div class="form-group">
                            {!! Form::label('option', 'Option'); !!}
                            {!! Form::text('option',isset($config)?$config['option']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Option' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('value', 'Value'); !!}
                            {!! Form::textarea('value',isset($config)?$config['value']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Value' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($config)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
