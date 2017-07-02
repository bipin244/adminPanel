<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="@if (Request::is('/')) {{'active'}} @endif treeview">
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="@if (Request::is('user')) {{'active'}} @endif treeview">
                <a href="{{ url('user') }}">
                    <i class="fa fa-user"></i> <span>User</span>
                </a>
            </li>
            <li class="@if (Request::is('account')) {{'active'}} @endif treeview">
                <a href="{{ url('account') }}">
                    <i class="fa fa-university"></i> <span>Account</span>
                </a>
            </li>
        </ul>
    </section>
  </aside>