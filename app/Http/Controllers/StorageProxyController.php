<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageProxyController extends Controller
{
    public function show(Request $request, string $path)
    {
        // Normalize path and prevent directory traversal
        $normalized = ltrim(str_replace(['..', '\\'], ['', '/'], $path), '/');
        if (!Storage::disk('public')->exists($normalized)) {
            abort(404);
        }
        return Storage::disk('public')->response($normalized);
    }
}


