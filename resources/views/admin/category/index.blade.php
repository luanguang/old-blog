@extends('admin.layout.page')
@section('title', '分类首页')

@section('content')
    <div id="content">
        <div class="panel" id="spy3">
            <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>{{ trans('view.category').trans('view.list') }}</span>
                <span class="pull-right">
          <a class="btn btn-default" href="{{ url('admin/category/create') }}">{{ trans('view.create') }}</a>
        </span>
            </div>
            <div class="panel-body pn">
                <div class="bs-component">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('view.name') }}</th>
                            <th>{{ trans('view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category['id'] }}</td>
                                <td>{{ $category['name'] }}</td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category['id']) }}">{{ trans('view.edit') }}</a>
                                    <a href="javascript:void(0)" data-delete-id="{{ $category['id'] }}" data-delete-url="admin/category" class="delete-btn">{{ trans('view.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
