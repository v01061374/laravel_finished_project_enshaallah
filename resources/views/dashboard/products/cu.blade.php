@extends('dashboard.layouts.master', ['sections' => ['dashboard','Products', isset($product)?'Edit':'Create']])
@section('title')
    @if(isset($product))
        Products - Edit
    @else
        Products - Create
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
                        {!! Form::open( ['route' => [isset($product)?'products.update':'products.store', isset($product)?$product['id']:'','files' => 'true', 'enctype' => 'multipart/form-data']]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Title'); !!}
                            {!! Form::text('title',isset($product)?$product['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('avg_minute_prod_time', 'Average production time (min)'); !!}
                            {!! Form::number('avg_minute_prod_time',isset($product)?$product['avg_minute_prod_time']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Average production time (min)' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('size_id', 'Size'); !!}
                            {!! Form::select('size_id',$sizes,isset($product)?$product['size_id']:'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('weight_id', 'Weight'); !!}
                            {!! Form::select('weight_id',$weights,isset($product)?$product['weight_id']:'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Category'); !!}
                            {!! Form::select('category_id',$productCategories,isset($product)?$product['category_id']:'',['required'=>'required', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Image'); !!}
                            <div class="input-group">
                                <div class="custom-file">
                                    {!! Form::file('image', ['class' => 'custom-file-input', 'accept' => 'image/*']) !!}
                                    {!! Form::label('image', 'Image', ['class' => 'custom-file-label']); !!}
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            {!! Form::submit(isset($product)?'update':'Submit!', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





@endsection
