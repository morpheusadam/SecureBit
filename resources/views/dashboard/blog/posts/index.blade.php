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
            <div class="breadcrumb-title pe-3">Blog Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Posts List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('dashboard.blog.posts.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> New Post
                    </a>
                    <a href="{{ route('dashboard.blog.categories.index') }}" class="btn btn-secondary ms-2">
                        <i class="bx bx-category"></i> Categories
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="posts-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Status</th>
                                <th>Publish Date</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <a href="{{ route('dashboard.blog.posts.edit', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td>{{ $post->author->username }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $post->category->name }}</span>
                                </td>
                                <td>
                                    @foreach($post->tags as $tag)
                                        <span class="badge bg-light text-dark">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($post->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($post->status == 'draft')
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    @else
                                        <span class="badge bg-secondary">Archived</span>
                                    @endif
                                </td>
                                <td>{{ $post->published_at ? $post->published_at->format('Y/m/d') : '-' }}</td>
                                <td>{{ $post->view_count }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('dashboard.blog.posts.edit', $post->id) }}" class="ms-2">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('dashboard.blog.posts.destroy', $post->id) }}" method="POST" class="ms-2">
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
        $('#posts-table').DataTable({
            order: [[0, 'desc']],
            columnDefs: [
                { targets: [5, 7], orderable: true },
                { targets: '_all', orderable: false }
            ]
        });
    });
</script>
@endsection