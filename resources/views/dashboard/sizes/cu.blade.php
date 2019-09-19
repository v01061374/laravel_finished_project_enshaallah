@extends('dashboard.layouts.master', ['sections' => ['dashboard','Sizes', isset($supplier)?'Edit':'Create']])
@section('title')
    @if(isset($supplier))
        Sizes - Edit
    @else
        Sizes - Create
    @endif
@endsection
@section('body-class')
    hold-transition sidebar-mini
@endsection

@section('content')




            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('max_cm_height')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('max_cm_width')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('max_cm_length')
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
                        {!! Form::open(['route' => [isset($size)?'sizes.update':'sizes.store', isset($size)?$size['id']:'']]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($size)?$size['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('max_cm_height', 'Max Height (cm)'); !!}
                            {!! Form::number('max_cm_height',isset($size)?$size['max_cm_height']:'', ['class' => 'form-control', 'placeholder' => 'Max Height (cm)']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('max_cm_width', 'Max Width (cm)'); !!}
                            {!! Form::number('max_cm_width',isset($size)?$size['max_cm_width']:'', ['class' => 'form-control', 'placeholder' => 'Max Width (cm)']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('max_cm_length', 'Max length (cm)'); !!}
                            {!! Form::number('max_cm_length',isset($size)?$size['max_cm_length']:'', ['class' => 'form-control', 'placeholder' => 'Max length (cm)']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($supplier)?'update':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
