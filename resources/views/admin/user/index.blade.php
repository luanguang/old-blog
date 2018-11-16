@extends('admin.layout.page')
@section('title', '用户')

@section('content')
    <div id="content">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">{{ trans('view.search') }}</span>
            </div>
            @include('layout.error')
            <div class="panel">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{ url('admin/user') }}" method="GET">
                        <div class="form-group">
                            <label for="name" class="col-lg-3 control-label">{{ trans('view.name') }}</label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <input type="text" id="name" name="name" class="form-control" value="{{ isset($search['name']) ? $search['name'] : old('name') }}">
                                </div>
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label for="email" class="col-lg-3 control-label">{{ trans('view.email') }}</label>--}}
                            {{--<div class="col-lg-8">--}}
                                {{--<div class="bs-component">--}}
                                    {{--<input type="text" id="email" name="email" class="form-control" value="{{ isset($search['email']) ? $search['email'] : old('email') }}">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="address" class="col-lg-3 control-label">{{ trans('view.address') }}</label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <input type="text" id="address" name="address" class="form-control" value="{{ isset($search['address']) ? $search['address'] : old('address') }}">
                                </div>
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label for="created_time" class="col-lg-3 control-label">创建时间</label>--}}
                            {{--<div class="col-lg-8">--}}
                                {{--<div class="bs-component">--}}
                                    {{--<input type="text" id="created_time" class="form-control date-range" name="created_time" value="{{ isset($search['created_time']) ? $search['created_time'] : old('created_time') }}">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<label for="is_deleted" class="col-lg-3 control-label">{{ trans('view.is_deleted') }}</label>--}}
                        {{--<div class="col-lg-8">--}}
                            {{--<div class="bs-component">--}}
                                {{--<div class="switch switch-info switch-inline">--}}
                                    {{--<input type="checkbox" id="is_deleted" name="is_deleted" class="form-control" value="1" {{ isset($is_deleted) ? 'checked' : '' }}>--}}
                                    {{--<label for="is_deleted"></label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <input type="hidden" name="is_admin" value="{{ isset($search['is_admin']) ? $search['is_admin'] : old('is_admin') }}">

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
        <span class="fa fa-table"></span>用户列表</span>
                <div class="pull-right hidden-xs">
                    <ul class="nav panel-tabs-border panel-tabs">
                        <li class="{{ !isset($search['is_admin']) ? 'active' : '' }}">
                            <a href="{{ url('admin/user?'.http_build_query(array_merge($search, ['is_admin' => '']))) }}">全部</a>
                        </li>
                        <li class="{{ isset($search['is_admin']) && $search['is_admin'] == 1 ? 'active' : '' }}">
                            <a href="{{ url('admin/user?'.http_build_query(array_merge($search, ['is_admin' => 1]))) }}">管理员</a>
                        </li>
                        <li class="{{ isset($search['is_admin']) && $search['is_admin'] == 2 ? 'active' : '' }}">
                            <a href="{{ url('admin/user?'.http_build_query(array_merge($search, ['is_admin' => 2]))) }}">普通会员</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/user/create') }}">创建用户</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{--<div class="panel-heading">--}}
        {{--<span class="panel-title">--}}
          {{--<span class="fa fa-table"></span>{{ trans('view.user').trans('view.list') }}</span>--}}
        {{--<span class="pull-right">--}}
          {{--<a class="btn btn-default" href="{{ url('admin/user/create') }}">{{ trans('view.create') }}</a>--}}
        {{--</span>--}}
            {{--</div>--}}
            <div class="panel-body pn">
                <div class="bs-component">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('view.name') }}</th>
                            <th>{{ trans('view.email') }}</th>
                            <th>身份</th>
                            <th>{{ trans('view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin == 1 ? '管理员' : '普通会员' }}</td>
                                <td>
                                    <a href="{{ url('admin/user/'.$user->id) }}">{{ trans('view.edit') }}</a>
                                    <a href="javascript:void(0)" data-delete-id="{{ $user->id }}" data-delete-url="admin/user" class="delete-btn">{{ trans('view.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <span class="pull-right">{{ $users->appends($search)->links() }}</span>
    </div>
@endsection