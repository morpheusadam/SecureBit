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
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="{{ route('dashboard.index') }}"><i class="bx bx-right-arrow-alt"></i>Overview</a>
                </li>
                <li> <a href="{{ url('dashboard-analytics') }}"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
                </li>
                <li> <a href="{{ url('dashboard-reminders') }}"><i class="bx bx-right-arrow-alt"></i>Reminders</a>
                </li>
            </ul>
        </li>

        <!-- Posts -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-edit'></i>
                </div>
                <div class="menu-title">Posts</div>
            </a>
            <ul>
                <li> <a href="{{ url('posts') }}"><i class="bx bx-right-arrow-alt"></i>All Posts</a>
                </li>
                <li> <a href="{{ url('posts/add') }}"><i class="bx bx-right-arrow-alt"></i>Add New</a>
                </li>
                <li> <a href="{{ url('posts/categories') }}"><i class="bx bx-right-arrow-alt"></i>Categories</a>
                </li>
                <li> <a href="{{ url('posts/tags') }}"><i class="bx bx-right-arrow-alt"></i>Tags</a>
                </li>
                <li> <a href="{{ url('posts/scheduled') }}"><i class="bx bx-right-arrow-alt"></i>Scheduled</a>
                </li>
            </ul>
        </li>

        <!-- Media Library -->
        <li>
            <a href="{{ url('media') }}">
                <div class="parent-icon"><i class='bx bx-image'></i>
                </div>
                <div class="menu-title">Media Library</div>
            </a>
        </li>

        <!-- Comments -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-comment'></i>
                </div>
                <div class="menu-title">Comments</div>
            </a>
            <ul>
                <li> <a href="{{ url('comments') }}"><i class="bx bx-right-arrow-alt"></i>All Comments</a>
                </li>
                <li> <a href="{{ url('comments/pending') }}"><i class="bx bx-right-arrow-alt"></i>Pending</a>
                </li>
                <li> <a href="{{ url('comments/spam') }}"><i class="bx bx-right-arrow-alt"></i>Spam</a>
                </li>
                <li> <a href="{{ url('comments/settings') }}"><i class="bx bx-right-arrow-alt"></i>Settings</a>
                </li>
            </ul>
        </li>

        <!-- Users Menu -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i></div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
            <li><a href="{{ route('dashboard.users.index') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a></li>
            <li><a href="{{ route('dashboard.users.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New User</a></li>
                <li><a href="{{ route('dashboard.users.profile') }}"><i class="bx bx-right-arrow-alt"></i>User Profile</a></li>
                <li><a href="{{ route('dashboard.users.roles') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a></li>
                <li><a href="{{ route('dashboard.users.permissions') }}"><i class="bx bx-right-arrow-alt"></i>Permissions</a></li>
            </ul>
        </li>
        <!-- End Users Menu -->

        <!-- Settings -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li> <a href="{{ url('settings/general') }}"><i class="bx bx-right-arrow-alt"></i>General</a>
                </li>
                <li> <a href="{{ url('settings/writing') }}"><i class="bx bx-right-arrow-alt"></i>Writing</a>
                </li>
                <li> <a href="{{ url('settings/reading') }}"><i class="bx bx-right-arrow-alt"></i>Reading</a>
                </li>
                <li> <a href="{{ url('settings/discussion') }}"><i class="bx bx-right-arrow-alt"></i>Discussion</a>
                </li>
                <li> <a href="{{ url('settings/permalinks') }}"><i class="bx bx-right-arrow-alt"></i>Permalinks</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>