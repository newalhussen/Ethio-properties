@extends('layouts.admin')
@section('title', 'All Houses')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        {{-- Header --}}
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>All Houses</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container-fluid">
            {{-- Houses Table --}}
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Region</th>
                                    <th>Location</th>
                                    <th>Bedrooms</th>
                                    <th>Bathrooms</th>
                                    <th>Price</th>
                                    <th>Posted By</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($houses as $index => $house)
                                    @php
                                        // safe images handling
                                        $img = null;
                                        if (!empty($house->images)) {
                                            if (is_array($house->images)) {
                                                $img = $house->images[0] ?? null;
                                            } else {
                                                $decoded = json_decode($house->images, true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                    $img = $decoded[0] ?? null;
                                                } else {
                                                    $parts = array_filter(array_map('trim', explode(',', $house->images)));
                                                    $img = $parts[0] ?? null;
                                                }
                                            }
                                        }
                                        $imgSrc = $img ? asset('storage/' . ltrim($img, '/')) : 'https://placehold.co/100x70?text=House';
                                    @endphp
                                    <tr>
                                        <td>{{ $houses->firstItem() + $index }}</td>
                                        <td class="text-center">
                                            <img src="{{ $imgSrc }}" alt="House Image" width="100">
                                        </td>
                                        <td>{{ $house->title_en ?? $house->title_am ?? 'N/A' }}</td>
                                        <td>{{ $house->region ?? 'N/A' }}</td>
                                        <td>{{ $house->subcity_en ?? $house->city_en ?? 'N/A' }}</td>
                                        <td>{{ $house->bedrooms ?? 'N/A' }}</td>
                                        <td>{{ $house->bathrooms ?? 'N/A' }}</td>
                                        <td>{{ $house->price ?? 'N/A' }}</td>
                                        <td>{{ $house->owner->name ?? 'N/A' }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $house->purpose ?? 'N/A')) }}</td>
                                        <td>{{ ucfirst($house->status ?? 'pending') }}</td>
                                        <td class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.houses.show', $house->id) }}" class="btn btn-info btn-sm">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.houses.destroy', $house->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">No houses found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $houses->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Delete confirmation --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this house?')) {
                this.closest('form').submit();
            }
        });
    });
});
</script>

@section('javascript')
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/js/pages/tables/jquery-datatable.js"></script>
@stop
@endsection
