<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link bg-danger {{ request()->is('admin') ? 'active' : '' }}">
                <i class="nav-icon fa fa-newspaper"></i>
                <p>
                    Blog
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts') ? 'active' : '' }}">
                        <i class="fa fa-eye nav-icon"></i>
                        <p>Ver Posts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.edit') }}" class="nav-link {{ request()->is('admin/posts/edit') ? 'active' : '' }}">
                        <i class="fa fa-pencil nav-icon"></i>
                        <p>Crear Posts</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>