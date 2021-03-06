@extends('admin.layout.page')
@section('title', !empty($user) ? '编辑用户' : '创建用户')

@section('content')
    <div id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">{{ !empty($user) ? trans('view.edit').trans('view.user') : trans('view.create').trans('view.user') }}</span>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" action="{{ !empty($user) ? url('admin/user/'.$user->id) : url('admin/user') }}" method="POST">
                            {!! csrf_field() !!}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            @if(!empty($user))
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">ID</label>
                                    <div class="col-lg-8">
                                        <div class="bs-component">
                                            <p class="form-control-static text-muted">{{ $user->id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <div class="form-group">
                                <label for="name" class="col-lg-3 control-label">{{ trans('view.name') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="text" id="name" name="name" class="form-control" value="{{ !empty($user) ? $user->name : old('name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Email" class="col-lg-3 control-label">{{ trans('view.email') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="text" id="Email" name="email" class="form-control" value="{{ !empty($user) ? $user->email : old('email') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-lg-3 control-label">{{ trans('view.address') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="text" id="address" name="address" class="form-control" value="{{ !empty($user) ? $user->address : old('address') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-lg-3 control-label">{{ trans('view.password') }}</label>
                                <div class="col-lg-8">
                                    <div class="bs-component">
                                        <input type="password" id="password" name="password" class="form-control" value="{{ !empty($user) ? $user->password : old('password') }}">
                                    </div>
                                </div>
                            </div>

                            @if (empty($user))
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-lg-3 control-label">{{ trans('view.password_confirmation') }}</label>
                                    <div class="col-lg-8">
                                        <div class="bs-component">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <label for="is_admin" class="col-lg-3 control-label">管理员</label>
                            <div class="col-lg-8">
                                <div class="bs-component">
                                    <div class="switch switch-info switch-inline">
                                    <input type="checkbox" id="is_admin" name="is_admin" class="form-control" value="1" {{ !empty($user->is_admin) ? 'checked' : '' }}>
                                    <label for="is_admin"></label>
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