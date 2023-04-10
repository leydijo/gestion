<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link"  href="{{ url('/home') }}">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link"  href="{{ url('/usuarios') }}">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="{{ url('/roles') }}">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    <a class="nav-link" href="{{ url('/blogs') }}">
        <i class=" fas fa-blog"></i><span>Blogs</span>
    </a>
    <a class="nav-link" href="{{ url('/clientes') }}">
        <i class=" fas fa-blog"></i><span>Clientes</span>
    </a>
</li>
