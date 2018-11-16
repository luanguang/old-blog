@extends('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <form method="POST" action="{{ url('article/'.$article->id) }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        @include ('layout.error')
                        <article class="blog-item">
                            <header>
                                <h4>{{ trans('view.title') }}</h4>
                                <br>
                                <h2 class="title">
                                    <lable for="title">
                                        <input type="text" id="title" name="title" class="form-control" value="{{ $article->title }}"/>
                                    </lable>
                                </h2>
                                <br>
                            </header>
                            <h4>{{ trans('view.content') }}</h4>
                            <br>
                            <div>
                                <textarea type="text" id="content" name="content" class="form-control" rows="8">{{ $article->content }}</textarea>
                            </div>
                            <br>
                            <h4>{{ trans('view.category') }}</h4>
                            <br>
                            <div>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        @if ($article->category_id == $category['id'])
                                        <option selected value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @else
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
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