@extends('layouts.admin')

@section('title', 'Property Owners')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-12">
                    <h2>Property Owners</h2>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                        <i class="zmdi zmdi-arrow-left"></i> Back to Users
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="header">
                    <h5>All Property Owners</h5>
                </div>
                <div class="body table-responsive">
                    @if($owners->count() > 0)
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($owners as $index => $owner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ $owner->avatar ? asset('storage/'.$owner->avatar) : asset('Smart/Admin/assets/images/avatar.jpg') }}" 
                                         class="rounded-circle" width="50" height="50" alt="Avatar">
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $owner->id) }}">
                                        {{ $owner->name }}
                                    </a>
                                </td>
                                <td>{{ $owner->email }}</td>
                                <td>{{ $owner->phone ?? 'N/A' }}</td>
                                <td>{{ $owner->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p class="text-muted text-center mb-0">No property owners found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
