@extends ('layout.page')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-18">
                <div class="blog-style-two content-to-load">
                    <!-- GENERAL BLOG POST -->
                    <article class="blog-item lazyload">
                        @include('layout.error')
                        <header>
                            <div class="col-sm-4">
                                <div class="thumb">
                                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="commenter" class="img-responsive radius">
                                </div>
                            </div>
                        </header>
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>{{ trans('view.name') }}:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('view.email') }}:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('view.address') }}:</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('fans') }}:</td>
                                <td>{{ $user->fans }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('view.self_introduction') }}:</td>
                                <td>{{ $user->self_introduction }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            @if (Auth::user()->follows->where('mind_id', $user->id)->count() > 0)
                                <button class="drop-btn">{{ trans('view.has_follow') }}</button>
                            @else
                                <form action="{{ url('user/'.$user->id) }}" method="post">
                                {!! csrf_field() !!}
                                <button class="drop-btn">{{ trans('view.follow') }}</button>
                                </form>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection