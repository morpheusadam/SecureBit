@extends('dashboard.layouts.app')

@section('style')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.roles.index') }}">Roles List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Role</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <!-- Error Display -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>The following errors occurred:</strong>
            <ul class="mt-2 mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Create New Role Form</h5>
                <hr/>
                
                <form method="POST" action="{{ route('dashboard.users.roles.store') }}">
                    @csrf
                    
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">System Role Name (English)*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required
                                               pattern="[a-zA-Z_]+" title="Only letters and underscores allowed">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Only English letters and underscore allowed (e.g., admin, editor)</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Role Title (Display Name)*</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="guard_name" class="form-label">Guard Name*</label>
                                        <select class="form-control @error('guard_name') is-invalid @enderror" 
                                                id="guard_name" name="guard_name" required>
                                            <option value="web" @selected(old('guard_name') == 'web')>Web</option>
                                            <option value="api" @selected(old('guard_name') == 'api')>API</option>
                                        </select>
                                        @error('guard_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="parent_id" class="form-label">Parent Role</label>
                                        <select class="form-control @error('parent_id') is-invalid @enderror" 
                                                id="parent_id" name="parent_id">
                                            <option value="">-- No Parent --</option>
                                            @foreach($parentRoles as $parent)
                                                <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>
                                                    {{ $parent->title }} ({{ $parent->name }})
                                                </option>
                                                
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_default" 
                                                       name="is_default" value="1" @checked(old('is_default'))>
                                                <label class="form-check-label" for="is_default">Default Role</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_active" 
                                                       name="is_active" value="1" @checked(old('is_active', true))>
                                                <label class="form-check-label" for="is_active">Active Status</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="permissions" class="form-label">Permissions</label>
                                        <select class="form-select select2 @error('permissions') is-invalid @enderror" 
        id="permissions" name="permissions[]" multiple="multiple">
    @foreach($permissionGroups as $group => $groupPermissions)
        <optgroup label="{{ ucfirst($group) }}">
            @foreach($groupPermissions as $permission)
                <option value="{{ $permission->id }}"
                    {{ in_array($permission->id, old('permissions', $selectedPermissions ?? [])) ? 'selected' : '' }}>
                    {{ $permission->title }} ({{ $permission->name }})
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>
                                        @error('permissions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Role</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#permissions').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: "Select permissions",
            allowClear: true,
            closeOnSelect: false
        });

        // Automatically set level based on parent selection
        $('#parent_id').change(function() {
            // In a real implementation, you might fetch the parent's level via AJAX
            // and set the level field accordingly
        });
    });
</script>
@endsection