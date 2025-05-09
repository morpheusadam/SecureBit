@extends("dashboard.layouts.app")

@section("style")
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> New User
                </a>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Registration Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->profile->full_name ?? '-' }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('Y/m/d H:i') }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="ms-2">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0 border-0 bg-transparent">
                                                <i class="bx bxs-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection

@section("script")
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            language: {
                url: "{{ asset('assets/plugins/datatable/js/persian.json') }}"
            },
            order: [[0, 'desc']]
        });
    });
</script>
@endsection