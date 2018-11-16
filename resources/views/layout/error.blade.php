
@if (Session::has('success'))
    <div class="alert alert-success">
        <ul class="list-group">
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
@endif



@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif