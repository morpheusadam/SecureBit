@extends('dashboard.layouts.app')

@section('style')
<link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Role Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title">System Roles</h5>
                    <a href="{{ route('dashboard.users.roles.create') }}" class="btn btn-primary">Create New Role</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="roles-table">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Level</th>
                                <th>Parent Role</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>
                                    <strong>{{ $role->name }}</strong>
                                    @if($role->is_default)
                                        <span class="badge bg-success ms-2">Default</span>
                                    @endif
                                </td>
                                <td>{{ $role->title }}</td>
                                <td>{{ $role->level }}</td>
                                <td>
                                    @if($role->parent)
                                        {{ $role->parent->title }}
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>
                                    @if($role->permissions->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($role->permissions->take(3) as $permission)
                                                <span class="badge bg-info">{{ $permission->title }}</span>
                                            @endforeach
                                            @if($role->permissions->count() > 3)
                                                <span class="badge bg-secondary">+{{ $role->permissions->count() - 3 }} more</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">No permissions</span>
                                    @endif
                                </td>
                                <td>
                                    @if($role->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('dashboard.users.roles.edit', $role->id) }}" 
                                           class="btn btn-sm btn-warning me-2" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('dashboard.users.roles.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    title="Delete" onclick="return confirm('Are you sure?')">
                                                <i class="bx bx-trash"></i>
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
@endsection

@section('script')
<script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#roles-table').DataTable({
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [5, 7] }, // Disable sorting for permissions and actions
                { searchable: false, targets: [7] } // Disable search for actions column
            ],
            order: [[3, 'asc']] // Default sort by level
        });
    });
</script>
@endsection