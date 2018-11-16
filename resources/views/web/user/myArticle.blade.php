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
                                    @if ($article->is_check == 0)
                                    <h3 class="title">
                                        <a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a>
                                    </h3>
                                        <span class="status_red pull-right">待审核</span>
                                    @else
                                    <h3 class="title">
                                        <a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a>
                                    </h3>
                                    <span class="status_green pull-right">审核通过</span>
                                    @endif
                                    <div class="meta-info">
                                        <img src="{{ asset('storage/'.$article->user->avatar) }}" alt="" class="thumb">
                                        <ul>
                                            <li>{{ $article->user->name }}</li>
                                            <li>{{ $article->created_at }}</li>
                                            <li>{{ !empty($categories[$article->category_id]) ? $categories[$article->category_id]['name'] : '暂无分类' }}</li>
                                            <li>{{ count($article->marks).trans('view.collection') }}</li>
                                            <li>{{ $article->comments.trans('view.comment') }}</li>
                                        </ul>
                                    </div>
                                </header>
                                <p>{{ str_limit($article->content, 100) }}</p>
                            </article>
                            <hr>
                        @endif
                    @endforeach
                    <button type="button" class="btn btn-default ph25"><a href="{{ url('article/create') }}">{{ trans('view.create') }}</a> </button>
                    <div class="pull-right">{{ $articles->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection