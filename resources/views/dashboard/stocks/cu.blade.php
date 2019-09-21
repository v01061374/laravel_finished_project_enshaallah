@extends('dashboard.layouts.master', ['sections' => ['dashboard','Stocks', isset($stock)?'Edit':'Create']])
@section('title')
    @if(isset($stock))
        Stocks - Edit
    @else
        Stocks - Create
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
                        {!! Form::open(['method' => 'POST','route' => [isset($stock)?'stocks.update':'stocks.store', $stock['id'] ?? '']]) !!}
                        {{--TODO form model binding to prevent duplicate database call in controller--}}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($stock)?$stock['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($stock)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
