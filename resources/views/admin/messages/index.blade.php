@extends('layouts.admin')
@section('title', 'Messages')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Messages</h2>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <form method="GET" class="form-inline">
                                <select name="type" class="form-control mr-2">
                                    <option value="">All types</option>
                                    <option value="inquiry" {{ request('type') == 'inquiry' ? 'selected' : '' }}>Inquiries</option>
                                    <option value="callback" {{ request('type') == 'callback' ? 'selected' : '' }}>Callbacks</option>
                                </select>
                                <select name="viewed" class="form-control mr-2">
                                    <option value="">All</option>
                                    <option value="0" {{ request('viewed') === '0' ? 'selected' : '' }}>Unviewed</option>
                                    <option value="1" {{ request('viewed') === '1' ? 'selected' : '' }}>Viewed</option>
                                </select>
                                <button class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>

                    @forelse($messages as $msg)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-3 rounded border">
                            <div class="d-flex align-items-start gap-3">
                                {{-- preview image --}}
                                @if($msg->post_preview && $msg->post_preview['image'])
                                    <img src="{{ $msg->post_preview['image'] }}" alt="img" style="width:72px;height:56px;object-fit:cover;border-radius:6px;">
                                @else
                                    <div style="width:72px;height:56px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999;font-size:12px;">
                                        No image
                                    </div>
                                @endif

                                <div>
                                    <div class="font-weight-bold">{{ $msg->customer->name ?? 'Guest' }} 
                                        <small class="text-muted">({{ $msg->type }})</small>
                                        @if(!$msg->viewed)
                                            <span class="badge badge-danger ml-2">new</span>
                                        @endif
                                    </div>

                                    <div class="text-muted small">
                                        {{ Str::limit($msg->content, 120) }}
                                    </div>

                                    @if($msg->post_preview)
                                        <div class="mt-1 small text-muted">
                                            <strong>{{ $msg->post_preview['title'] }}</strong>
                                            @if($msg->post_preview['price'])
                                                • ETB {{ number_format($msg->post_preview['price']) }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="small text-muted">{{ $msg->created_at->diffForHumans() }}</div>

                                <div class="mt-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-info">View</a>

                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this message?')">Delete</button>
                                    </form>

                                    @if(!$msg->viewed)
                                        <form action="{{ route('admin.messages.markViewed', $msg->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Mark viewed</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No messages found.</p>
                    @endforelse

                    <div class="mt-3">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
