@extends('admin.layout.page')
@section('title', '文章首页')
@section('content')
    <div id="content">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">{{ trans('view.search') }}</span>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{ url('admin/article') }}" method="GET">
                        <div class="form-group">
                            <label for="title" class="col-lg-3 control-label">{{ trans('view.title') }}</label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <input type="text" id="title" name="title" class="form-control" value="{{ isset($search['title']) ? $search['title'] : old('title') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-lg-3 control-label">{{ trans('view.category') }}</label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <select name="category_id" class="form-control">
                                        <option value="">请选择类别</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" @if (isset($search['category_id']) && $category['id'] == $search['category_id']) selected @endif>{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <label for="is_check" class="col-lg-3 control-label">审核通过</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <div class="switch switch-info switch-inline">
                                    <input type="checkbox" id="is_check" name="is_check" class="form-control" value="1" {{ isset($search['is_check']) ? 'checked' : '' }}>
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

        <div class="panel" id="spy3">
            <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>{{ trans('view.article').trans('view.list') }}</span>
                {{--<span class="pull-right">--}}
          {{--<a class="btn btn-default" href="{{ url('admin/article/create') }}">{{ trans('view.create') }}</a>--}}
        {{--</span>--}}
            </div>
            <div class="panel-body pn">
                <div class="bs-component">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('view.title') }}</th>
                            <th>{{ trans('view.content') }}</th>
                            <th>{{ trans('view.category') }}</th>
                            <th>审核结果</th>
                            <th>{{ trans('view.view') }}</th>
                            <th>{{ trans('view.collections') }}</th>
                            <th>回复数</th>
                            <th>{{ trans('view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ str_limit($article->content, 50) }}</td>
                                <td>{{ $article->category_id == 0 ? '-' : $categories[$article->category_id]['name'] }}</td>
                                <td>{{ $article->is_check == 1 ? '审核通过' : '审核未通过' }}</td>
                                <td>{{ $article->browses }}</td>
                                <td>{{ $article->collections }}</td>
                                <td>{{ $article->comments }}</td>
                                <td>
                                    <a href="{{ url('admin/article/'.$article->id) }}">{{ trans('view.edit') }}</a>
                                    <a href="javascript:void(0)" data-delete-id="{{ $article->id }}" data-delete-url="admin/article" class="delete-btn">{{ trans('view.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <span class="pull-right">{!! $articles->appends($search)->render() !!}</span>
    </div>
@endsection
