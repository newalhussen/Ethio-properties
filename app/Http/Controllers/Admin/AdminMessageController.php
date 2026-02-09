<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Car;
use App\Models\House;
use Illuminate\Support\Facades\Storage;

class AdminMessageController extends Controller
{
    // List messages grouped / filterable (newest first)
    public function index(Request $request)
    {
        // optional status filters: type (inquiry/callback) or viewed
        $q = Message::with(['customer'])->orderByDesc('created_at');

        // quick filters via querystring
        if ($request->filled('type')) {
            $q->where('type', $request->type);
        }
        if ($request->filled('viewed')) {
            $q->where('viewed', $request->viewed == '1' ? 1 : 0);
        }

        $messages = $q->paginate(20)->withQueryString();

        // Resolve a small preview for each message (image, title, price)
        $messages->getCollection()->transform(function ($msg) {
            $postPreview = $this->resolvePostPreview($msg->post_id);
            $msg->post_preview = $postPreview;
            return $msg;
        });

        return view('admin.messages.index', compact('messages'));
    }

    // Show single message
    public function show(Message $message)
    {
        // mark viewed if not
        if (! $message->viewed) {
            $message->viewed = true;
            $message->save();
        }

        $message->load('customer');

        $message->post_preview = $this->resolvePostPreview($message->post_id);

        return view('admin.messages.show', compact('message'));
    }

    // delete a message
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }

    // ajax / form to mark viewed
    public function markViewed(Message $message)
    {
        $message->viewed = true;
        $message->save();
        return back()->with('success', 'Message marked viewed.');
    }

    // Helper: try to find the post in cars or houses and return small preview
    private function resolvePostPreview($postId)
    {
        if (!$postId) return null;

        // try Car first
        $car = Car::find($postId);
        if ($car) {
            $image = $this->firstImageUrl($car->images);
            $title = $car->title ?? trim(($car->brand ?? '') . ' ' . ($car->model ?? ''));
            $price = $car->price ?? null;
            return [
                'type' => 'car',
                'id' => $car->id,
                'title' => $title,
                'price' => $price,
                'image' => $image,
            ];
        }

        // try House
        $house = House::find($postId);
        if ($house) {
            $image = $this->firstImageUrl($house->images);
            // pick a readable title (title_en or fallback)
            $title = $house->title_en ?? $house->title_am ?? $house->title ?? ($house->city ?? 'House');
            $price = $house->price ?? null;
            return [
                'type' => 'house',
                'id' => $house->id,
                'title' => $title,
                'price' => $price,
                'image' => $image,
            ];
        }

        return null;
    }

    private function firstImageUrl($images)
    {
        if (empty($images)) return null;

        // images may be JSON/text or array
        if (is_string($images)) {
            $decoded = @json_decode($images, true);
            if (is_array($decoded)) $images = $decoded;
            else $images = [$images];
        }

        if (is_array($images) && count($images)) {
            $p = ltrim($images[0], '/');
            if (preg_match('/^https?:\/\//i', $p)) return $p;
            if (Storage::disk('public')->exists($p)) return asset('storage/' . $p);
            if (file_exists(public_path($p))) return asset($p);
            if (file_exists(public_path('uploads/' . $p))) return asset('uploads/' . $p);
            // fallback
            return $p;
        }

        return null;
    }
}
