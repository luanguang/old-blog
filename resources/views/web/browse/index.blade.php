@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-one content-to-load">
                    <!-- GENERAL BLOG POST -->
                    @include ('layout.error')
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ trans('view.title') }}</th>
                            <th>{{ trans('view.content') }}</th>
                            <th>{{ trans('view.time') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($browses as $browse)
                            @if (isset($browse->article))
                            <tr>
                                <td><a href="{{ url('article/'.$browse->article->id.'/show') }}">{{ $browse->article->title }}</a></td>
                                <td>{{ str_limit($browse->article->content, 10) }}</td>
                                <td>{{ $browse->created_at }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>文章已被删除</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div>{{ $browses->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection