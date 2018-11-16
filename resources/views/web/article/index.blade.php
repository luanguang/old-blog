@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    @include ('layout.error')
                    @foreach ($articles as $article)
                        @if (isset($article->user))
                    <article class="blog-item">
                        <header>
                            <h2 class="title">
                                <a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a>
                            </h2>
                            <div class="meta-info">
                                <img src="{{ asset('storage/'.$article->user->avatar) }}" alt="" class="thumb">
                                <ul>
                                    <li>{{ $article->user->name }}</li>
                                    <li>{{ !empty($categories[$article->category_id]) ? $categories[$article->category_id]['name'] : '暂无分类' }}</li>
                                    <li>{{ count($article->marks).trans('view.collection') }}</li>
                                    <li>{{ $article->comments.trans('view.comment') }}</li>
                                    <li>{{ $article->browses.trans('view.browse') }}</li>
                                    <li>{{ $article->created_at }}</li>
                                </ul>
                            </div>
                        </header>
                        <p>{{ str_limit($article->content, 100) }}</p>
                        <hr>
                    </article>
                        @endif
                    @endforeach

                    <button type="button" class="btn btn-default ph25"><a href="{{ url('article/create') }}">{{ trans('view.create') }}</a> </button>

                    <div class="pull-right">{{ $articles->links() }}</div>
                </div>
            </div>
            @include ('layout.sidebar')
        </div>
    </div>
@endsection

