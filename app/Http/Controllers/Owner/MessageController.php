<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\House;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
public function store(Request $request)
{
    // Validate basic fields
    $request->validate([
        'post_id' => 'required|integer',
        'post_type' => 'required|in:car,house',
        'type' => 'required|in:inquiry,callback',

        'name' => 'required|string',

        // Inquiry fields
        'email' => $request->type === 'inquiry' ? 'required|email' : 'nullable',
        'content' => $request->type === 'inquiry' ? 'required|string' : 'nullable',

        // Callback fields
        'phone' => $request->type === 'callback' ? 'required|string' : 'nullable',
    ]);

    // Fetch the correct model depending on property type
    if ($request->post_type === 'house') {
        $post = \App\Models\House::findOrFail($request->post_id);
    } else {
        $post = \App\Models\Car::findOrFail($request->post_id);
    }

    // Owner = user who created the listing
    $ownerId = $post->user_id;

    if (!$ownerId) {
        return back()->with('error', 'Property has no owner assigned.');
    }

    // Save message
    Message::create([
        'owner_id' => $ownerId,
        'customer_id' => auth()->id() ?? null,
        'post_id' => $post->id,
        'post_type' => $request->post_type,
        'type' => $request->type,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'content' => $request->content,
        'viewed' => false,
    ]);

    return back()->with('success', 'Your message has been sent!');
}

}
