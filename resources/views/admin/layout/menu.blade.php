<aside id="sidebar_left" class="nano nano-light affix">  
  <div class="sidebar-left-content nano-content">
    <ul class="nav sidebar-menu">
      <li class="sidebar-label pt15">{{trans('view.system')}}</li>
      <li>
        <a href="{{ url('admin/user') }}">
          <span class="fa fa-user"></span>
          <span class="sidebar-title">{{trans('view.user')}}</span>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/article') }}">
          <span class="fa fa-file-text"></span>
          <span class="sidebar-title">{{trans('view.article')}}</span>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/category') }}">
          <span class="fa fa-files-o"></span>
          <span class="sidebar-title">{{trans('view.category')}}</span>
        </a>
      </li>
    </ul>
    <div class="sidebar-toggle-mini">
      <a href="#">
        <span class="fa fa-sign-out"></span>
      </a>
    </div>
  </div>
</aside>