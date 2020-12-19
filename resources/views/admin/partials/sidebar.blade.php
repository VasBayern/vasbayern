<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <img src="{{asset('admin_assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('admin_assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        @if(Auth::check())
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        @endif
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{ route('admin.dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <p>
              Cửa hàng
              <i class="fas fa-angle-left right"></i>
              <!-- <span class="badge badge-info right">6</span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.categories') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.brands') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thương hiệu</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.products') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sản phẩm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.sizes') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Size</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.colors') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Màu sắc</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.coupons') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Mã giảm giá</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fab fa-blogger-b"></i>
            <p>
              Tin tức
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.content.categories') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.content.posts') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bài viết</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.content.comments') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bình luận</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="{{ route('admin.tags') }}" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Thẻ / Nhãn
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Đơn hàng
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.orders') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đơn hàng</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đánh giá</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ url('api/admin/media') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Thư viện ảnh
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.banners') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Banner
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.newsletters') }}" class="nav-link">
            <i class="nav-icon far fa-newspaper"></i>
            <p>
              Đăng ký bản tin
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.contacts') }}" class="nav-link">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>
              Bình luận khách hàng
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>