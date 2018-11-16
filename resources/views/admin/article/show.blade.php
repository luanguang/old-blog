@extends('admin.layout.page')
@section('title', !empty($article) ? '编辑文章' : '新建文章')

@section('content')
    <div id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">{{ !empty($article) ? trans('view.edit').trans('view.article') : trans('view.create'). trans('view.article') }}</span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ !empty($article) ? url('admin/article/'.$article->id) : url('admin/article') }}" method="POST">
                            {!! csrf_field() !!}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            @if(!empty($article))
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">ID</label>
                                    <div class="col-lg-8">
                                        <div class="bs-component">
                                            <p class="form-control-static text-muted">{{ $article->id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <div class="form-group">
                                <label for="title" class="col-lg-3 control-label">{{ trans('view.title') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="text" id="title" name="title" class="form-control" value="{{ !empty($article) ? $article->title : old('title') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-lg-3 control-label">{{ trans('view.content') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="text" id="content" name="content" class="form-control" value="{{ !empty($article) ? $article->content : old('content') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="col-lg-3 control-label">{{ trans('view.category') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <select name="category_id" class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label for="is_check" class="col-lg-3 control-label">审核通过</label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <div class="switch switch-info switch-inline">
                                        <input type="checkbox" id="is_check" name="is_check" class="form-control" value="1" {{ !empty($article->is_check) ? 'checked' : '' }}>
                                        <label for="is_check"></label>
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
