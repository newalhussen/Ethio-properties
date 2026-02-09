<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $ownerId = auth()->id();

        // 4 tabs
        $newChats = Message::where('owner_id', $ownerId)->where('type', 'inquiry')->where('viewed', false)->latest()->get();
        $viewedContacts = Message::where('owner_id', $ownerId)->where('type', 'inquiry')->where('viewed', true)->latest()->get();
        $callBacks = Message::where('owner_id', $ownerId)->where('type', 'callback')->latest()->get();
        $savedAds = Message::where('owner_id', $ownerId)->where('type', 'saved_ad')->latest()->get();

        return view('owner.customers.index', compact('newChats', 'viewedContacts', 'callBacks', 'savedAds'));
    }
}
