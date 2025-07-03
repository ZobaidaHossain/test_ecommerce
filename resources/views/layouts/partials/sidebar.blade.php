
<div class="flapt-sidemenu-wrapper">
    <!-- Desktop Logo -->
    {{-- <div class="flapt-logo">
      <h3 class="text-center m-2">E-Commerece</h3>
    </div> --}}

    <!-- Side Nav -->
    <div class="flapt-sidenav" id="flaptSideNav">
      <!-- Side Menu Area -->
      <div class="side-menu-area">
        <!-- Sidebar Menu -->
        @php
        $PermissionUser = App\Models\PermissionRole::getPermission('User', Auth::user()->role_id);
        $PermissionRole = App\Models\PermissionRole::getPermission('Role', Auth::user()->role_id);
        $PermissionSlider = App\Models\PermissionRole::getPermission('Slider', Auth::user()->role_id);
        $PermissionProduct = App\Models\PermissionRole::getPermission('Product', Auth::user()->role_id);
        $PermissionOrder = App\Models\PermissionRole::getPermission('Order', Auth::user()->role_id);
    @endphp

        <nav>
          <ul class="sidebar-menu" data-widget="tree">

            <li class="treeview-menu">
              <a class="menu-active" href="{{route('backend.admin.dashboard')}}"
                ><i class="bx bx-home-heart"></i>
                <span>Dashboard</span>
            </li>
@if(!empty($PermissionUser))
            {{-- user --}}
            <li class="treeview">
                <a href="javascript:void(0)"
                  ><i class="bx bx-user-circle"></i
                  ><span>User</span>
                  <i class="fa fa-angle-right"></i
                ></a>
                <ul class="treeview-menu">
                  <li><a href="{{route('backend.user.add')}}">User Add</a></li>
                  <li><a href="{{route('backend.user.list')}}">User List</a></li>

                </ul>
              </li>
              @endif
              @if(!empty($PermissionRole))
                   {{-- role --}}
            <li class="treeview">
                <a href="javascript:void(0)"
                  ><i class="bx bx-user-circle"></i
                  ><span>Role</span>
                  <i class="fa fa-angle-right"></i
                ></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.role.create') }}">Role Add</a></li>
                    <li><a href="{{ route('backend.role.index') }}">Role List</a></li>
                </ul>
              </li>
              @endif
              @if(!empty($PermissionSlider))

              {{-- one table --}}
              <li class="treeview">
                <a href="javascript:void(0)"
                  ><i class="bx bxs-eraser"></i><span>Slider</span>
                  <i class="fa fa-angle-right"></i
                ></a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('backend.slider.create') }}">Slider Form</a></li>
                  <li><a href="{{route('backend.slider.index')}}">Slider Table</a></li>
                </ul>
              </li>
              @endif
              @if(!empty($PermissionProduct))

                 {{-- Product --}}
                 <li class="treeview">
                    <a href="javascript:void(0)"
                      ><i class="bx bxs-cart"></i><span>Product</span>
                      <i class="fa fa-angle-right"></i
                    ></a>
                    <ul class="treeview-menu">
                      <li><a href="{{ route('backend.product.create') }}">Product Form</a></li>
                      <li><a href="{{route('backend.product.index')}}">Product Table</a></li>
                    </ul>
                  </li>
                  @endif
                  @if(!empty($PermissionOrder))
                    {{-- Order --}}
                 <li class="treeview">
                  <a href="javascript:void(0)"
                    ><i class="bx bxs-cart"></i><span>Order</span>
                    <i class="fa fa-angle-right"></i
                  ></a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('backend.order.create') }}">Order Form</a></li>
                    <li><a href="{{route('backend.order.index')}}">Order Table</a></li>
                  </ul>
                </li>
                @endif



          </ul>
        </nav>
      </div>


    </div>
  </div>
