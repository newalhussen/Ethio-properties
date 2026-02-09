@extends('layouts.admin')
@section('title', 'Rejected Houses')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header"><div class="row"><div class="col-lg-7"><h2>Rejected Houses</h2></div></div></div>

        <div class="container-fluid">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Region</th>
                                    <th>Bedrooms</th>
                                    <th>Price</th>
                                    <th>Rejection Reason</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($houses as $house)
                                    @php
                                        $images = [];
                                        if (!empty($house->images)) {
                                            if (is_array($house->images)) { $images = $house->images; }
                                            elseif (is_string($house->images)) {
                                                $dec = json_decode($house->images, true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($dec)) $images = $dec;
                                                else $images = array_filter(array_map('trim', explode(',', $house->images)));
                                            }
                                        }
                                        $imageUrl = !empty($images[0]) ? asset('storage/' . ltrim($images[0], '/')) : 'https://placehold.co/100x70?text=House';
                                    @endphp

                                    <tr>
                                        <td><img src="{{ $imageUrl }}" alt="House" width="100"></td>
                                        <td>{{ $house->title_en ?? $house->title_am ?? 'N/A' }}</td>
                                        <td>{{ $house->region ?? 'N/A' }}</td>
                                        <td>{{ $house->bedrooms ?? 'N/A' }}</td>
                                        <td>{{ $house->price ?? 'N/A' }}</td>
                                        <td>{{ $house->rejection_reason ?? 'N/A' }}</td>
                                        <td><span class="badge bg-danger">Rejected</span></td>
                                        <td class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.houses.show', $house->id) }}" class="btn btn-info btn-sm"><i class="zmdi zmdi-eye"></i></a>

                                            <form action="{{ route('admin.houses.approve', $house->id) }}" method="POST" class="d-inline reapprove-form">
                                                @csrf
                                                <button type="button" class="btn btn-success btn-sm reapprove-btn">Re-approve</button>
                                            </form>

                                            <form action="{{ route('admin.houses.destroy', $house->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn"><i class="zmdi zmdi-delete"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center text-muted">No rejected houses</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">{{ $houses->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- small JS for actions --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if (confirm('Delete this house permanently?')) this.closest('form').submit();
        });
    });

    document.querySelectorAll('.reapprove-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if (confirm('Re-approve this house?')) this.closest('form').submit();
        });
    });
});
</script>

@section('javascript')
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
@stop
@endsection
