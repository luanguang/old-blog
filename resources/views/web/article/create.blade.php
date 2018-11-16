@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <form method="POST" action="{{ url('article') }}">
                        {!! csrf_field() !!}
                        @include ('layout.error')
                        <article class="blog-item">
                            <header>
                                <lable for="title"><h4>{{ trans('view.title') }}</h4>
                                    <br>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control"/>
                                </lable>
                            </header>
                            <br>
                            <div class="comment-input">
                                <h4>{{ trans('view.content') }}</h4>
                                <br>
                                <textarea name="content" id="content" rows="8"  class="form-control">{{ old('content') }}</textarea>
                            </div>
                            <br>
                            <h4>{{ trans('view.category') }}</h4>
                            <br>
                            <div>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                        </article>

                        <div class="pull-right">
                            <button class="btn btn-prime btn-mid" type="submit">{{ trans('view.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection