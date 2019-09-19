@extends('dashboard.layouts.master', ['sections' => ['dashboard','MaterialCategories', isset($materialCategory)?'Edit':'Create']])
@section('title')
    @if(isset($materialCategory))
        MaterialCategories - Edit
    @else
        MaterialCategories - Create
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
                        {!! Form::open(['route' => [isset($materialCategory)?'materialCategories.update':'materialCategories.store', isset($materialCategory)?$materialCategory['id']:'']]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($materialCategory)?$materialCategory['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(isset($materialCategory)?'update':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
