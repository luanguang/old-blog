@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <form method="POST" action="{{ url('user/'.$user->id) }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        @include ('layout.error')
                        <article class="blog-item">
                            <header>
                                <h4>{{ trans('view.name') }}</h4>
                                <br>
                                <h2 class="title">
                                    <lable for="name">
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"/>
                                    </lable>
                                </h2>
                            </header>
                            <br>
                            <h4>{{ trans('view.address') }}</h4>
                            <br>
                            <div class="comment-input">
                                <input name="address" id="address"  class="form-control" value="{{ $user->address }}" />
                            </div>
                            <div>
                            <br>
                            <h4>{{ trans('view.self_introduction') }}</h4>
                            <br>
                            <textarea name="self_introduction" id="self_introduction" rows="3"  class="form-control">{{ $user->self_introduction }}</textarea>
                            </div>
                        </article>
                        <br>
                        <div class="pull-right">
                            <button class="btn btn-prime btn-mid" type="submit">{{ trans('view.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection