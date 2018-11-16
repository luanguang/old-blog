@extends ('layout.page')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <form method="POST" action="{{ url('login') }}" id="contact">
                        {!! csrf_field() !!}
                        @include ('layout.error')
                        <div>
                            <lable for="email"><h4>{{ trans('view.email') }}</h4></lable>
                            <br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <br>
                        <div>
                            <lable for="password"><h4>{{ trans('view.password') }}</h4></lable>
                            <br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <br>
                        <div class="pull-right">
                            <button class="btn btn-prime btn-mid" type="submit">{{ trans('view.login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection