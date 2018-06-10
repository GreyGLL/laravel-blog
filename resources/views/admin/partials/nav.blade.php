<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview menu-open">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>
            Inicio
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('admin/posts') ? 'active' : '' }}">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Blog</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.posts.index') }}"class="nav-link {{ request()->is('admin/posts') ? 'active' : '' }}">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Ver Posts</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
      <a href="#" data-toggle:"modal" data-target:"#myModal" class="nav-link">
          <i class="nav-icon fa fa-th"></i>
          <p>
            Crear posts
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
    </ul>
  </nav>