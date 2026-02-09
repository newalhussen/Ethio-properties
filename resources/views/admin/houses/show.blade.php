@extends('layouts.admin')
@section('title', 'View House')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/lightgallery/css/lightgallery.css">
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header mb-3">
            <div class="row">
                <div class="col-md-6"><h2>House Details</h2></div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.houses.index') }}" class="btn btn-secondary"><i class="zmdi zmdi-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>

        {{-- Status Badge --}}
        @php
            $statusColor = match($house->status) {
                'approved' => 'success',
                'rejected' => 'danger',
                default => 'warning'
            };
        @endphp
        <div class="mb-3"><span class="badge bg-{{ $statusColor }}">{{ ucfirst($house->status) }}</span></div>

        <div class="row">
            {{-- Left: General / Specs --}}
            <div class="col-md-6">
                <div class="card mb-3"><div class="card-header bg-primary text-white">General</div>
                    <div class="card-body">
                        <p><strong>Title:</strong> {{ $house->title_en ?? $house->title_am }}</p>
                        <p><strong>Region:</strong> {{ $house->region ?? 'N/A' }}</p>
                        <p><strong>Location:</strong> {{ $house->subcity_en ?? $house->city_en ?? 'N/A' }}</p>
                        <p><strong>Price:</strong> {{ $house->price }}</p>
                        <p><strong>Purpose:</strong> {{ $house->purpose }}</p>
                        <p><strong>Bedrooms:</strong> {{ $house->bedrooms }}</p>
                        <p><strong>Bathrooms:</strong> {{ $house->bathrooms }}</p>
                        <p><strong>Area (m²):</strong> {{ $house->area_m2 }}</p>
                        <p><strong>Built Year:</strong> {{ $house->built_year ?? 'N/A' }}</p>
                        <p><strong>Posted By:</strong> {{ $house->owner->name ?? 'N/A' }}</p>
                        <p><strong>Created At:</strong> {{ $house->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Rejection Reason:</strong> {{ $house->rejection_reason ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="card mb-3"><div class="card-header bg-dark text-white">Contact</div>
                    <div class="card-body">
                        <p><strong>Phone:</strong> {{ $house->contact_phone ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $house->contact_email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Right: Media --}}
            <div class="col-md-6">
                <div class="card mb-3"><div class="card-header bg-success text-white">Media</div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($imageUrls as $img)
                                <div class="col-md-4 mb-2">
                                    <img src="{{ $img }}" alt="House" class="img-fluid border rounded">
                                </div>
                            @empty
                                <p class="text-muted">No images uploaded.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card"><div class="card-header bg-secondary text-white">Description</div>
                    <div class="card-body">
                        <p>{!! nl2br(e($house->description_en ?? $house->description_am)) !!}</p>
                    </div>
                </div>
            </div>
        </div>

{{-- Approve / Reject / Featured Buttons --}}
<div class="mt-4 d-flex gap-2 flex-wrap">

    <button id="approveBtn" class="btn btn-success">
        <i class="zmdi zmdi-check"></i> Approve
    </button>

    <button id="rejectBtn" class="btn btn-danger">
        <i class="zmdi zmdi-close"></i> Reject
    </button>

    {{-- ⭐ Featured Toggle --}}
    <button
        id="featuredBtn"
        class="btn {{ $house->is_featured ? 'btn-warning' : 'btn-outline-warning' }}">
        <i class="zmdi zmdi-star"></i>
        {{ $house->is_featured ? 'Unmark Featured' : 'Mark as Featured' }}
    </button>

</div>


        {{-- Reject Modal --}}
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="rejectForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header"><h5 class="modal-title">Reject House</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rejection_reason">Reason</label>
                                <textarea id="rejection_reason" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="submit" class="btn btn-danger">Submit Rejection</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@section('javascript')
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const houseId = {{ $house->id }};
    const csrf = '{{ csrf_token() }}';

    // ✅ Approve Button
    document.getElementById('approveBtn').addEventListener('click', async () => {
        const res = await fetch(`/admin/houses/${houseId}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json'
            }
        });
        const data = await res.json().catch(() => ({}));
        if (res.ok) {
            Swal.fire({
                icon: 'success',
                title: 'House Approved',
                text: data.message || 'The house has been approved successfully.',
                confirmButtonColor: '#3085d6'
            }).then(() => location.href = '{{ route("admin.houses.index") }}');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Something went wrong while approving.'
            });
        }
    });

    // 🚫 Reject Button
    document.getElementById('rejectBtn').addEventListener('click', async () => {
        const { value: reason } = await Swal.fire({
            title: 'Reject House',
            input: 'textarea',
            inputLabel: 'Enter the reason for rejection:',
            inputPlaceholder: 'Type rejection reason here...',
            inputAttributes: { 'aria-label': 'Rejection reason' },
            showCancelButton: true,
            confirmButtonText: 'Reject',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            preConfirm: (val) => {
                if (!val.trim()) {
                    Swal.showValidationMessage('Rejection reason is required');
                    return false;
                }
                return val;
            }
        });

        if (reason) {
            const res = await fetch(`/admin/houses/${houseId}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ rejection_reason: reason })
            });

            const data = await res.json().catch(() => ({}));
            if (res.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'House Rejected',
                    text: data.message || 'The house has been rejected successfully.',
                    confirmButtonColor: '#3085d6'
                }).then(() => location.href = '{{ route("admin.houses.index") }}');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Something went wrong while rejecting.'
                });
            }
        }
    });

    document.getElementById('featuredBtn').addEventListener('click', async () => {
     console.log('FEATURED CLICKED');
    const res = await fetch(`/admin/houses/${houseId}/toggle-featured`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
        }
    });

    const data = await res.json().catch(() => ({}));

    if (res.ok) {
        Swal.fire({
            icon: 'success',
            title: 'Updated',
            text: data.message || 'Featured status updated.',
        }).then(() => location.reload());
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message || 'Failed to update featured status.',
        });
    }
});

});


</script>
@endsection


