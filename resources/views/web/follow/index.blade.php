@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-two content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <article class="blog-item lazyload">
                        @include('layout.error')
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>{{ trans('view.UserName') }}</td>
                                <td>{{ trans('view.action') }}</td>
                            </tr>
                                @foreach ($follows as $follow)
                                    <tr>
                                        <td><a href="{{ url('user/'.$follow->mind_id) }}">{{ $follow->user->name }}</a></td>
                                        <td><a href="{{ url('follow/'.$follow->id.'/deleted') }}" onclick="if (confirm('确定要取消关注吗？') == false) return false;">{{ trans('view.cancel').trans('view.follow') }}</a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {{ $follows->links() }}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection