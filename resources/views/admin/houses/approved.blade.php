@extends('layouts.admin')
@section('title', 'Approved Houses')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header"><div class="row"><div class="col-lg-7"><h2>Approved Houses</h2></div></div></div>

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
                                    <th>Bathrooms</th>
                                    <th>Price</th>
                                    <th>Posted By</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($houses as $house)
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
                                        <td>{{ $house->bathrooms ?? 'N/A' }}</td>
                                        <td>{{ $house->price ?? 'N/A' }}</td>
                                        <td>{{ $house->owner->name ?? 'N/A' }}</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                        <td><a href="{{ route('admin.houses.show', $house->id) }}" class="btn btn-info btn-sm">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">{{ $houses->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('javascript')
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
@stop
@endsection
