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
            <div class="breadcrumb-title pe-3">User Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New User</h5>
                <hr/>

               @if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>خطاهای زیر رخ داده است:</strong>
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
    <strong>موفقیت!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

                



<form method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                               id="username" name="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" 
                                               name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" 
                                               value="{{ old('full_name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                                               id="avatar" name="avatar">
                                        @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="hidden" name="is_active" value="0">
                                            <input class="form-check-input" type="checkbox" id="is_active" 
                                                   name="is_active" value="1" 
                                                   @if(old('is_active', true)) checked @endif>
                                            <label class="form-check-label" for="is_active">Active User</label>
                                        </div>
                                        @error('is_active')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="roles" class="form-label">User Roles</label>
                                        <select class="form-select select2 @error('roles') is-invalid @enderror" 
                                                id="roles" name="roles[]" multiple="multiple">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" 
                                                    @if(old('roles') && in_array($role->id, old('roles'))) selected @endif>
                                                    {{ $role->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save User</button>
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
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    });
</script>
@endsection