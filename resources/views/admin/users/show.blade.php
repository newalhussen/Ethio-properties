@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h2>User Details</h2>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                        <i class="zmdi zmdi-arrow-left"></i> Back to Users
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            {{-- User Info --}}
            <div class="card mb-4">
                <div class="body d-flex align-items-center gap-3">
                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('Smart/Admin/assets/images/avatar.jpg') }}" 
                         class="rounded-circle" width="90" height="90" alt="Avatar">
                    <div>
                        <h4>{{ $user->name }}</h4>
                        <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Role:</strong> 
                            <span class="badge 
                                @if($user->role == 'admin') bg-danger 
                                @elseif($user->role == 'owner') bg-success 
                                @else bg-primary @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                        <p class="mb-0"><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Houses (if Owner) --}}
            @if($user->role === 'owner')
            <div class="card mb-4">
                <div class="header">
                    <h5>🏠 Houses Posted by {{ $user->name }}</h5>
                </div>
                <div class="body table-responsive">
                    @if($user->houses->count() > 0)
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Posted On</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach($user->houses as $index => $house)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>
        @php
            $images = is_array($house->images) ? $house->images : json_decode($house->images, true);
            $image = !empty($images) ? asset('storage/' . $images[0]) : asset('Smart/Admin/assets/images/no-image.png');
        @endphp
        <img src="{{ $image }}" alt="House Image" width="70" height="70" class="rounded">
    </td>
    <td>{{ $house->title ?? 'N/A' }}</td>
    <td>{{ $house->location ?? 'N/A' }}</td>
    <td>
        @if(is_numeric($house->price))
            ${{ number_format((float)$house->price, 2) }}
        @else
            N/A
        @endif
    </td>
    <td>
        <span class="badge {{ $house->status === 'approved' ? 'bg-success' : 'bg-warning' }}">
            {{ ucfirst($house->status ?? 'pending') }}
        </span>
    </td>
    <td>{{ $house->created_at->format('M d, Y') }}</td>
</tr>
@endforeach

                        </tbody>
                    </table>
                    @else
                        <p class="text-muted text-center mb-0">No houses posted yet.</p>
                    @endif
                </div>
            </div>

            {{-- Cars (if Owner) --}}
            <div class="card mb-4">
                <div class="header">
                    <h5>🚗 Cars Posted by {{ $user->name }}</h5>
                </div>
                <div class="body table-responsive">
                    @if($user->cars->count() > 0)
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Posted On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->cars as $index => $car)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>
        @php
            $images = is_array($car->images) ? $car->images : json_decode($car->images, true);
            $image = !empty($images) ? asset('storage/' . $images[0]) : asset('Smart/Admin/assets/images/no-image.png');
        @endphp
        <img src="{{ $image }}" alt="Car Image" width="70" height="70" class="rounded">
    </td>
    <td>{{ $car->title ?? 'N/A' }}</td>
    <td>{{ $car->brand ?? 'N/A' }}</td>
    <td>{{ $car->model ?? 'N/A' }}</td>
    <td>
        @if(is_numeric($car->price))
            ${{ number_format((float)$car->price, 2) }}
        @else
            N/A
        @endif
    </td>
    <td>
        <span class="badge {{ $car->status === 'approved' ? 'bg-success' : 'bg-warning' }}">
            {{ ucfirst($car->status ?? 'pending') }}
        </span>
    </td>
    <td>{{ $car->created_at->format('M d, Y') }}</td>
</tr>
@endforeach

                        </tbody>
                    </table>
                    @else
                        <p class="text-muted text-center mb-0">No cars posted yet.</p>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endsection
