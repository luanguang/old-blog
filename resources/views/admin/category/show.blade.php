@extends('admin.layout.page')
@section('title', !empty($category) ? '编辑分类' : '新建分类')

@section('content')

    <div id="content" class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">{{ !empty($category) ? trans('view.edit').trans('view.category') : trans('view.create').trans('view.category') }}</span>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" action="{{ !empty($category) ? url('admin/category/'.$category->id) : url('admin/category') }}" method="POST">
                            {!! csrf_field() !!}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            @if(!empty($category))
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">ID</label>
                                    <div class="col-lg-8">
                                        <div class="bs-component">
                                            <p class="form-control-static text-muted">{{ $category->id }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{ method_field('PUT') }}
                            @endif

                            <div class="form-group">
                                <label for="name" class="col-lg-3 control-label">{{ trans('view.name') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="text" id="name" name="name" class="form-control" value="{{ !empty($category) ? $category->name : old('name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-default ph25">{{ trans('view.submit') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
