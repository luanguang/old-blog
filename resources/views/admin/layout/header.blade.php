<!-- Start: Header -->
<header class="navbar navbar-fixed-top navbar-shadow">
  <div class="navbar-branding">
    <a class="navbar-brand" href="{{url('/')}}">
      <b>欢乐日常</b>后台
    </a>
    <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
  </div>
  <ul class="nav navbar-nav navbar-right">
    <li class="dropdown menu-merge">
      <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
        <img src="{{ !empty(Auth::user()) ? url('storage/'.Auth::user()->avatar) : '' }}" alt="avatar" class="mw30 br64">
        <span class="hidden-xs pl15"> {{ !empty(Auth::user()) ? Auth::user()->name : '' }} </span>
        <span class="caret caret-tp hidden-xs"></span>
      </a>
      <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
        <li class="dropdown-footer">
          <a href="{{ url('logout') }}" class="">
          <span class="fa fa-power-off pr5"></span> {{ trans('view.logout') }} </a>
        </li>
      </ul>
    </li>
  </ul>
</header>
<!-- End: Header -->