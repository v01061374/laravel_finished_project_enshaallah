@extends('dashboard.layouts.master', ['sections' => ['dashboard','ProductCategories', isset($productCategory)?'Edit':'Create']])
@section('title')
    @if(isset($productCategory))
        ProductCategories - Edit
    @else
        ProductCategories - Create
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
                        {!! Form::open(['route' => [isset($productCategory)?'productCategories.update':'productCategories.store', isset($productCategory)?$productCategory['id']:'']]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($productCategory)?$productCategory['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('commission_percent', 'Commission (%)'); !!}
                            {!! Form::number('commission_percent',isset($productCategory)?$productCategory['commission_percent']:'', ['class' => 'form-control', 'placeholder' => 'Commission (%)', 'min' => 0, 'max' => 100]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($productCategory)?'update':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
