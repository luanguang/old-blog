<div class="col-md-18">
    <form method="POST" action="{{ url('article/'.$article->id.'/comment') }}">
        {!! csrf_field() !!}
        @include ('layout.error')
        <div class="comment-input">
            <label for="content">{{ trans('view.reply') }}
                <textarea name="content" id="content" rows="8" placeholder="Write your content here" class="form-input" style="margin:0px; width:650px; height:182px;"></textarea>
            </label>
        </div>
        <div class="pull-right">
            <input type="submit" value="{{ trans('view.submit') }}">
        </div>
    </form>
</div>