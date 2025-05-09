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
        <!-- Dashboard -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li><a href="{{ route('dashboard.index') }}"><i class="bx bx-right-arrow-alt"></i>Overview</a></li>
                <li><a href="{{ route('dashboard.analytics') }}"><i class="bx bx-right-arrow-alt"></i>Analytics</a></li>
            </ul>
        </li>

        <!-- Posts -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-edit'></i></div>
                <div class="menu-title">Posts</div>
            </a>
            <ul>
                <li><a href="{{ route('dashboard.blog.posts.index') }}"><i class="bx bx-right-arrow-alt"></i>All Posts</a></li>
<li><a href="{{ route('dashboard.blog.posts.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New</a></li>
<li><a href="{{ route('dashboard.blog.categories.index') }}"><i class="bx bx-right-arrow-alt"></i>Categories</a></li>
            </ul>
        </li>

        <!-- Media Library -->
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-image'></i></div>
                <div class="menu-title">Media Library</div>
            </a>
        </li>

        <!-- Comments -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-comment'></i></div>
                <div class="menu-title">Comments</div>
            </a>
            <ul>
                <li><a href="#"><i class="bx bx-right-arrow-alt"></i>All Comments</a></li>
                <li><a href="#"><i class="bx bx-right-arrow-alt"></i>Pending</a></li>
            </ul>
        </li>

        <!-- User Management -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i></div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
                <li><a href="{{ route('dashboard.users.index') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a></li>
                <li><a href="{{ route('dashboard.users.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New User</a></li>
                <li><a href="{{ route('dashboard.users.profile') }}"><i class="bx bx-right-arrow-alt"></i>Profile</a></li>
                <li><a href="{{ route('dashboard.users.roles.index') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a></li>

                <li><a href="{{ route('dashboard.users.roles.create') }}"><i class="bx bx-right-arrow-alt"></i>Create Roles</a></li>
                <!-- Removed permissions link since it requires role parameter -->
            </ul>
        </li>

        <!-- Settings -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cog'></i></div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li><a href="#"><i class="bx bx-right-arrow-alt"></i>General</a></li>
                <li><a href="#"><i class="bx bx-right-arrow-alt"></i>Writing</a></li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>