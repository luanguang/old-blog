@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one">
                            <!-- GENERAL BLOG POST -->
                    <div class="about-author">
                        <div class="row">
                            <div class="col-sm-4 hidden-xs">
                                <div class="thumb">
                                    <img src="{{ url('storage/'.$user->avatar) }}" alt="author name" class="img-responsive">
                                </div>
                                <br>
                                <div>
                                    <p><a href="{{ url('user/'.$user->id.'/upload') }}" class="btn btn-prime btn-small">{{ trans('view.upload').trans('view.avatar') }}</a></p>
                                </div>
                            </div>
                            <article class="blog-item lazyload">

                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td class="table-td">{{ trans('view.name') }}</td>
                                        <td class="table-td">{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-td">{{ trans('view.email') }}</td>
                                        <td class="table-td">{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-td">{{ trans('view.address') }}</td>
                                        <td class="table-td">{{ Auth::user()->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-td">{{ trans('view.fans') }}</td>
                                        <td class="table-td">{{ Auth::user()->fans }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-td">{{ trans('view.self_introduction') }}</td>
                                        <td class="table-td">{{ Auth::user()->self_introduction }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p><a href="{{ url('user/'.Auth::user()->id.'/edit') }}" class="btn btn-prime btn-small">{{ trans('view.edit') }}</a></p>
                            </article>
                        </div>
                    </div>

                    <hr>

                    <!-- VIDEO BLOG POST -->
                    <article class="blog-item">
                        <header>
                            <h2 class="title">
                                {{ trans('view.my').trans('view.comment') }}
                            </h2>
                            <br>
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td>{{ trans('view.article') }}</td>
                                    <td>{{ trans('view.reply') }}</td>
                                </tr>
                                @foreach ($comments as $comment)
                                    @if (isset($comment->article))
                                <tr>
                                    <td><a href="{{ url('article/'.$comment->article->id) }}">{{ $comment->article->title }}</a></td>
                                    <td><a href="{{ url('article/'.$comment->article->id) }}">{{ str_limit($comment->content, 10) }}</a></td>
                                </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $comments->links() }}
                            </div>
                        </header>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection