@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8" x-data="{ tab: 'pending' }">
  <h1 class="text-2xl font-bold mb-6 text-[#440057]">Admin Moderation</h1>

  <div class="flex gap-3 mb-6">
    <button @click="tab='pending'" :class="tab==='pending' ? 'bg-[#440057] text-white' : 'bg-white text-gray-700'" class="px-4 py-2 rounded-lg border">Pending</button>
    <button @click="tab='approved'" :class="tab==='approved' ? 'bg-[#440057] text-white' : 'bg-white text-gray-700'" class="px-4 py-2 rounded-lg border">Approved</button>
    <button @click="tab='rejected'" :class="tab==='rejected' ? 'bg-[#440057] text-white' : 'bg-white text-gray-700'" class="px-4 py-2 rounded-lg border">Rejected</button>
  </div>

  <div x-show="tab==='pending'" class="space-y-8">
    <div>
      <h2 class="text-xl font-semibold mb-3">Pending Houses</h2>
      <div class="grid md:grid-cols-2 gap-4">
        @foreach($housesPending as $h)
          <div class="bg-white rounded-xl shadow p-4">
            <div class="flex justify-between items-center">
              <div>
                <div class="font-semibold">{{ $h->title_en ?? $h->title }}</div>
                <div class="text-gray-500 text-sm">ETB {{ number_format($h->price) }} • {{ $h->region }}</div>
              </div>
              <div class="flex gap-2">
                <form action="{{ route('admin.houses.approve', $h->id) }}" method="POST">@csrf<button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button></form>
                <form action="{{ route('admin.houses.reject', $h->id) }}" method="POST" class="flex gap-2">@csrf
                  <input name="reason" class="border rounded px-2 py-1" placeholder="Reason" required>
                  <button class="px-3 py-1 bg-red-600 text-white rounded">Reject</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $housesPending->links() }}</div>
    </div>

    <div>
      <h2 class="text-xl font-semibold mb-3">Pending Cars</h2>
      <div class="grid md:grid-cols-2 gap-4">
        @foreach($carsPending as $c)
          <div class="bg-white rounded-xl shadow p-4">
            <div class="flex justify-between items-center">
              <div>
                <div class="font-semibold">{{ $c->brand }} {{ $c->model }}</div>
                <div class="text-gray-500 text-sm">ETB {{ number_format($c->price) }}</div>
              </div>
              <div class="flex gap-2">
                <form action="{{ route('admin.cars.approve', $c->id) }}" method="POST">@csrf<button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button></form>
                <form action="{{ route('admin.cars.reject', $c->id) }}" method="POST" class="flex gap-2">@csrf
                  <input name="reason" class="border rounded px-2 py-1" placeholder="Reason" required>
                  <button class="px-3 py-1 bg-red-600 text-white rounded">Reject</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $carsPending->links() }}</div>
    </div>
  </div>

  <div x-show="tab==='approved'" class="space-y-8">
    <div>
      <h2 class="text-xl font-semibold mb-3">Approved Houses</h2>
      <div class="grid md:grid-cols-3 gap-4">
        @foreach($housesApproved as $h)
          <div class="bg-white rounded-xl shadow p-4">
            <div class="font-semibold">{{ $h->title_en ?? $h->title }}</div>
            <div class="text-gray-500 text-sm">Approved {{ optional($h->approved_at)->diffForHumans() }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $housesApproved->links() }}</div>
    </div>

    <div>
      <h2 class="text-xl font-semibold mb-3">Approved Cars</h2>
      <div class="grid md:grid-cols-3 gap-4">
        @foreach($carsApproved as $c)
          <div class="bg-white rounded-xl shadow p-4">
            <div class="font-semibold">{{ $c->brand }} {{ $c->model }}</div>
            <div class="text-gray-500 text-sm">Approved {{ optional($c->approved_at)->diffForHumans() }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $carsApproved->links() }}</div>
    </div>
  </div>

  <div x-show="tab==='rejected'" class="space-y-8">
    <div>
      <h2 class="text-xl font-semibold mb-3">Rejected Houses</h2>
      <div class="grid md:grid-cols-2 gap-4">
        @foreach($housesRejected as $h)
          <div class="bg-white rounded-xl shadow p-4">
            <div class="font-semibold">{{ $h->title_en ?? $h->title }}</div>
            <div class="text-red-600 text-sm">{{ $h->rejection_reason }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $housesRejected->links() }}</div>
    </div>

    <div>
      <h2 class="text-xl font-semibold mb-3">Rejected Cars</h2>
      <div class="grid md:grid-cols-2 gap-4">
        @foreach($carsRejected as $c)
          <div class="bg-white rounded-xl shadow p-4">
            <div class="font-semibold">{{ $c->brand }} {{ $c->model }}</div>
            <div class="text-red-600 text-sm">{{ $c->rejection_reason }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $carsRejected->links() }}</div>
    </div>
  </div>
</div>

@endsection














