@extends('layouts.admin')
@section('title', 'View Car')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/lightgallery/css/lightgallery.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
    .info-card { margin-bottom: 20px; }
    .car-image { max-height: 150px; object-fit: cover; border-radius: 5px; }
    .badge-status { font-size: 0.9em; }
</style>
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        {{-- Header --}}
        <div class="block-header mb-3">
            <div class="row">
                <div class="col-md-6">
                    <h2>Car Details</h2>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">
                        <i class="zmdi zmdi-arrow-left"></i> Back to All Cars
                    </a>
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-primary ms-2">
        <i class="zmdi zmdi-edit"></i> Edit Car
    </a>
                </div>
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            @php
                $statusColor = match($car->status) {
                    'approved' => 'success',
                    'rejected' => 'danger',
                    default => 'warning'
                };
            @endphp
            <span class="badge badge-{{ $statusColor }} badge-status">
                {{ ucfirst($car->status) }}
            </span>
        </div>

        {{-- General Info --}}
        <div class="row">
            <div class="col-md-6 info-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">General Info</div>
                    <div class="card-body">
                        <p><strong>Title:</strong> {{ $car->title }}</p>
                        <p><strong>Title (AM):</strong> {{ $car->title_am }}</p>
                        <p><strong>Brand:</strong> {{ $car->brand }}</p>
                        <p><strong>Model:</strong> {{ $car->model }}</p>
                        <p><strong>Year:</strong> {{ $car->year }}</p>
                        <p><strong>Sale/Rent:</strong> {{ ucfirst($car->sale_rent) }}</p>
                        <p><strong>Price:</strong> {{ number_format($car->price, 2) }} {{ $car->price_type }}</p>
                        <p><strong>Featured:</strong> {{ $car->is_featured ? 'Yes' : 'No' }}</p>
                        <p><strong>Posted By:</strong> {{ $car->owner->name ?? 'N/A' }}</p>
                        <p><strong>Created At:</strong> {{ $car->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Specs --}}
            <div class="col-md-6 info-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">Specifications</div>
                    <div class="card-body">
                        <p><strong>Transmission:</strong> {{ $car->transmission }}</p>
                        <p><strong>Body Type:</strong> {{ $car->body_type }}</p>
                        <p><strong>Color:</strong> {{ $car->color }}</p>
                        <p><strong>Fuel:</strong> {{ $car->fuel }}</p>
                        <p><strong>Engine Size:</strong> {{ $car->engine_size }}</p>
                        <p><strong>Seats:</strong> {{ $car->seats }}</p>
                        <p><strong>Doors:</strong> {{ $car->doors }}</p>
                        <p><strong>Drive Type:</strong> {{ $car->drive_type }}</p>
                        <p><strong>Condition:</strong> {{ $car->condition }}</p>
                        <p><strong>Mileage:</strong> {{ $car->mileage }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="row">
            <div class="col-md-12 info-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">Description</div>
                    <div class="card-body">
                        <p><strong>Description (EN):</strong><br>{!! nl2br(e($car->description)) !!}</p>
                        <p><strong>Description (AM):</strong><br>{!! nl2br(e($car->description_am)) !!}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="row">
            <div class="col-md-12 info-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">Contact Info</div>
                    <div class="card-body">
                        <p><strong>Seller Type:</strong> {{ $car->seller_type }}</p>
                        <p><strong>Phone:</strong> {{ $car->contact_phone }}</p>
                        <p><strong>Email:</strong> {{ $car->contact_email }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Media --}}
        <div class="row">
            <div class="col-md-12 info-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Media</div>
                    <div class="card-body">
                        {{-- Images --}}
                        <div class="row">
                            @forelse($images as $img)
                                <div class="col-md-3 mb-2">
                                    <img src="{{ asset('storage/' . $img) }}" class="img-fluid car-image" alt="Car Image">
                                </div>
                            @empty
                                <p>No images uploaded</p>
                            @endforelse
                        </div>

                        {{-- Video --}}
                        @if($car->video)
                        <div class="mt-3">
                            <video width="100%" controls>
                                <source src="{{ asset('storage/' . $car->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Approve / Reject Buttons --}}
<div class="mt-3 mb-5 d-flex gap-2 flex-wrap">

    {{-- Approve --}}
    <button class="btn btn-success" id="approveBtn">
        <i class="zmdi zmdi-check"></i> Approve
    </button>

    {{-- Reject --}}
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
        <i class="zmdi zmdi-close"></i> Reject
    </button>

{{-- Featured Toggle --}}
<button
    class="btn {{ $car->is_featured ? 'btn-warning' : 'btn-outline-warning' }}"
    id="featuredBtn"
    data-car-id="{{ $car->id }}"
>
    <i class="zmdi zmdi-star"></i>
    {{ $car->is_featured ? 'Unmark Featured' : 'Mark as Featured' }}
</button>

</div>


        {{-- Reject Modal --}}
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="rejectForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reject Car</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rejection_reason">Reason</label>
                                <textarea class="form-control" name="rejection_reason" id="rejection_reason" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Submit Rejection</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carId = {{ $car->id }};

    // Helper to safely parse JSON
    async function safeJson(res) {
        try {
            return await res.json();
        } catch {
            return {};
        }
    }

    // Approve
    document.getElementById('approveBtn').addEventListener('click', async function() {
        const res = await fetch(`/admin/cars/${carId}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        });

        const data = await safeJson(res);
        if (res.ok) {
            alert(data.message || 'Car approved successfully!');
            location.reload();
        } else {
            alert(data.message || 'Something went wrong while approving.');
        }
    });

    // Reject
    document.getElementById('rejectForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const reason = document.getElementById('rejection_reason').value;

        const res = await fetch(`/admin/cars/${carId}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ rejection_reason: reason })
        });

        const data = await safeJson(res);
        if (res.ok) {
            alert(data.message || 'Car rejected successfully!');
            location.reload();
        } else {
            alert(data.message || 'Something went wrong while rejecting.');
        }
    });
});

// Toggle Featured
document.getElementById('featuredBtn').addEventListener('click', async function () {

    const carId = this.dataset.carId; // ✅ THIS WAS MISSING

    const res = await fetch(`/admin/cars/${carId}/toggle-featured`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        }
    });

    const data = await res.json();

    if (res.ok) {
        alert(data.message || 'Featured status updated!');
        location.reload();
    } else {
        alert(data.message || 'Failed to update featured status.');
    }
});


</script>
@stop
