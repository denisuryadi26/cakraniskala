<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function flushCache()
    {
        try {
            Cache::flush(); // Menghapus semua cache
            return response()->json(['message' => 'Cache flushed successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
