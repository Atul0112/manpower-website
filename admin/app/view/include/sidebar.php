<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin/index.php?path=home&method=index" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Panel</span>
  </a><br>
  <!-- Sidebar -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="/admin/index.php?path=home&method=index" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a><br>
          <ul class="nav nav-treeview">
            <li class="nav-item active">
              <a href="/admin/index.php?path=contact&method=index" class="nav-link">
                <i class="nav-icon far fa-circle text-success"></i>
                <p>Query</p>
              </a>
            </li><br>
            <li class="nav-item">
              <a href="#" class="nav-link nav-link.active">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Pages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item nav-link.active">
                  <a href="/admin/index.php?path=add_page&method=index" class="nav-link">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Add pages</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/index.php?path=view_pages&method=index" class="nav-link nav-link.active">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>View pages</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>