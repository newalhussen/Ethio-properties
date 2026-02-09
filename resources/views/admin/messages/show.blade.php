@extends('layouts.admin')
@section('title', 'Message')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Message Details</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Back to messages</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="body p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ $message->customer->name ?? 'Guest' }}
                                <small class="text-muted">({{ $message->customer->email ?? '—' }})</small>
                            </h4>

                            <p class="text-muted small">Sent: {{ $message->created_at->toDayDateTimeString() }}</p>

                            <hr>

                            <h5>Message</h5>
                            <p>{{ $message->content }}</p>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-body">
                                <h6>About listing</h6>

                                @if($message->post_preview)
                                    @if($message->post_preview['image'])
                                        <img src="{{ $message->post_preview['image'] }}" class="w-100 mb-2" style="height:140px;object-fit:cover;">
                                    @endif
                                    <p class="font-weight-bold mb-0">{{ $message->post_preview['title'] }}</p>
                                    @if($message->post_preview['price'])
                                        <p class="text-muted small">Price: {{ number_format($message->post_preview['price'],2) }} Birr</p>
                                    @endif
                                @else
                                    <p class="text-muted small">No linked listing found (post_id: {{ $message->post_id }})</p>
                                @endif

                                <hr>

                                <form action="{{ route('admin.messages.markViewed', $message->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success mb-2" {{ $message->viewed ? 'disabled' : '' }}>Mark viewed</button>
                                </form>

                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
