<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Syndron</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="{{ url('index') }}"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
                </li>
                <li> <a href="{{ url('dashboard-alternate') }}"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
                </li>
            </ul>
        </li>

        <!-- Users Menu - Similar to WordPress -->
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
                <ul>
                    <li> <a href="{{ url('users') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a>
                    </li>
                    <li> <a href="{{ url('users/add') }}"><i class="bx bx-right-arrow-alt"></i>Add New</a>
                    </li>
                    <li> <a href="{{ url('users/profile') }}"><i class="bx bx-right-arrow-alt"></i>Your Profile</a>
                    </li>
                    <li> <a href="{{ url('users/roles') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a>
                    </li>
                    <li> <a href="{{ url('users/permissions') }}"><i class="bx bx-right-arrow-alt"></i>Permissions</a>
                    </li>
                </ul>
        </li>
        <!-- End Users Menu -->

    </ul>
    <!--end navigation-->
</div>
