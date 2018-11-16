@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    @include ('layout.error')
                    <article class="blog-item">
                        <header>
                            <h2 class="title">
                                {{ $article->title }}
                            </h2>
                            <div class="meta-info">
                                <img src="{{ asset('storage/'.$article->user->avatar) }}" alt="" class="thumb">
                                <ul>
                                    @if (isset($article->user))
                                    <li><a href="{{ url('user/'.$article->user->id) }}">{{ $article->user->name }}</a></li>
                                    @else
                                    <li>{{ $article->user->id }}</li>
                                    @endif
                                    <li>{{ $article->created_at }}</li>
                                    <li>{{ !empty($categories[$article->category_id]) ? $categories[$article->category_id]['name'] : '暂无分类' }}</li>
                                    <li>{{ $article->collections.trans('view.collection') }}</li>
                                    <li>{{ $article->comments.trans('view.comment') }}</li>
                                    <li>{{ trans('view.browse') }}:{{ $article->browses }}</li>
                                </ul>
                            </div>
                        </header>
                        <p>{{ $article->content }}</p>
                    </article>
                    @auth
                    <div class="pull-right">
                        <tr>
                            @if (!empty($is_collection))
                                <td>{{ trans('view.has_mark') }}</td>
                            @else
                            <td><a href="{{ url('article/'.$article->id.'/mark') }}">{{ trans('view.mark') }}</a></td>
                            @endif
                            @if (Auth::user()->id == $article->user->id)
                            <td><a href="{{ url('article/'.$article->id.'/edit') }}">{{ trans('view.edit') }}</a></td>
                            <td><a href="{{ url('article/'.$article->id.'/deleted') }}" onclick="if (confirm('确定要删除吗？') == false) return false;">{{ trans('view.delete') }}</a></td>
                            @endif
                        </tr>
                    </div>
                    <section class="comments-area">
                        <h3>{{ $article->comments."条".trans('view.comment') }}</h3>

                        <div class="comments">
                            <hr class="small">

                            <!-- First level comment -->
                            <ul>
                                @foreach ($article->comment as $comment)
                                <li>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="thumb">
                                                <img src="{{ asset('storage/'.$comment->user->avatar) }}" alt="commenter" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-sm-20">
                                            <p>{{ $comment->content }}</p>
                                            <p>
                                                <a href="{{ url('user/'.$comment->user_id.'/show') }}" class="author">{{ isset($comment->user) ? $comment->user['name'] : $comment->user_id }}</a>
                                                <span>{{ $comment->created_at }}</span>
                                                @if ($comment->user_id == Auth::user()->id)
                                                <span class="pull-right"><a href="{{ url('comment/'.$comment->id) }}" onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a></span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <hr class="small">
                                </li>
                                @endforeach
                            </ul>
                        </div> <!-- end of .comments -->

                        <div class="comment-form">
                            <h3>发表评论</h3>

                            <form action="{{ url('article/'.$article->id.'/comment') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="comment-input">
                                    <textarea name="content" id="content" rows="8" placeholder="Write your comment here" class="form-input"></textarea>
                                </div>
                                <button class="btn btn-prime btn-mid" type="submit">{{ trans('view.PostComment') }}</button>
                            </form>
                        </div> <!-- end of .comment-form -->
                        @endauth
                    </section>
                </div>
                @guest
                <div class="guest"><a href="{{ route('login') }}">登陆</a>后可评论（没账号请先<a href="{{ route('register') }}">注册</a>）</div>
                @endguest
            </div>
        </div>
    </div>

@endsection