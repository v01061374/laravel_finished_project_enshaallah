@extends('dashboard.layouts.master', ['sections' => ['dashboard','Materials', isset($material)?'Edit':'Create']])
@section('title')
    @if(isset($material))
        Materials - Edit
    @else
        Materials - Create
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
                        {!! Form::open( ['route' => [isset($material)?'materials.update':'materials.store', isset($material)?$material['id']:''], 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($material)?$material['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Category'); !!}
                            {!! Form::select('category_id',$materialCategories,isset($material)?$material['category_id']:'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit(isset($material)?'Update!':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
