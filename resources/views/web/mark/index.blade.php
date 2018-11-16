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
                            <th>#</th>
                            <th>{{ trans('view.title') }}</th>
                            <th>{{ trans('view.content') }}</th>
                            <th>{{ trans('view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach (Auth::user()->marks as $mark)
                            @if (isset($mark->article))
                            <tr>
                                <td>{{ $mark->id }}</td>
                                <td><a href="{{ url('article/'.$mark->article->id.'/show') }}">{{ $mark->article->title }}</a></td>
                                <td>{{ str_limit($mark->article->content, 10) }}</td>
                                <td>
                                    <a href="{{ url('mark/'.$mark->id.'/deleted') }}" onclick="if (confirm('确定要取消收藏吗？') == false) return false;">{{ trans('view.delete') }}</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection