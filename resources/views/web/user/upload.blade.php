@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <form method="POST" action="" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @include ('layout.error')
                        <div>
                            <lable for="file"><h4>{{ trans('view.file').trans('view.upload') }}</h4></lable>
                            <br>
                            <input type="file" name="source" id="file" class="form-control">
                        </div>
                       <br>
                        <div class="pull-right">
                            <button class="btn btn-prime btn-mid" type="submit">{{ trans('view.confirm').trans('view.upload') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection