@extends('dashboard.layouts.master', ['sections' => ['dashboard','MaterialCategories']])
@section('title')
    MaterialCategories
@endsection
@section('body-class')
    hold-transition layout-fixed sidebar-mini
@endsection

    <!-- Content Wrapper. Contains page content -->

        <!-- /.content-header -->
@section('content')
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-5">
                    <a href="{{route('materialCategories.create')}}">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable materialCategories-dataTable" role="grid">
                            <thead>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materialCategories as $i => $materialCategory)
                                    <tr>
                                        <td class="sorting_1">
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            {{$materialCategory['title']}}
                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                {{--link to purchase--}}
                                            <a title="edit" href="{{route('materialCategories.edit', ['id' => \App\CustomClasses\Hasher::encode($materialCategory['id'])])}}"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="{{route('materialCategories.delete',\App\CustomClasses\Hasher::encode($materialCategory['id']))}}"></i>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.c <tent -->

    <!-- /.content-wrapper -->
@endsection

