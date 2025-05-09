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
                        <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Errors:</strong>
            <ul class="mt-2 mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Role: {{ $role->title }}</h5>
                <hr/>
                
                <form method="POST" action="{{ route('dashboard.users.roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">System Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $role->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Only letters, numbers and underscores</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Display Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $role->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_default" 
                                                   name="is_default" value="1" @if(old('is_default', $role->is_default)) checked @endif>
                                            <label class="form-check-label" for="is_default">Default Role</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_active" 
                                                   name="is_active" value="1" @if(old('is_active', $role->is_active)) checked @endif>
                                            <label class="form-check-label" for="is_active">Active Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="parent_id" class="form-label">Parent Role</label>
                                        <select class="form-select @error('parent_id') is-invalid @enderror" 
                                                id="parent_id" name="parent_id">
                                            <option value="">-- No Parent --</option>
                                            @foreach($roles as $r)
                                                @if($r->id != $role->id)
                                                <option value="{{ $r->id }}" 
                                                    @if(old('parent_id', $role->parent_id) == $r->id) selected @endif>
                                                    {{ $r->title }}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="permissions" class="form-label">Permissions</label>
                                        <select class="form-select select2 @error('permissions') is-invalid @enderror" 
                                                id="permissions" name="permissions[]" multiple="multiple">
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->id }}" 
                                                    @if(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))) selected @endif>
                                                    {{ $permission->title }} ({{ $permission->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('permissions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">Cancel</button>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Update Role</button>
                                        <a href="{{ route('dashboard.users.roles.permissions', $role->id) }}" 
                                           class="btn btn-outline-info">
                                            Manage Advanced Permissions
                                        </a>
                                    </div>
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
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: "Select permissions",
            allowClear: true
        });

        // Disable parent role selection if this is a root role
        @if($role->level === 0)
            $('#parent_id').prop('disabled', true);
            $('#parent_id').closest('.mb-3').append('<small class="text-muted">Root roles cannot have parents</small>');
        @endif
    });
</script>
@endsection