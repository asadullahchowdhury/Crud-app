<?php

namespace App\Http\Controllers;

use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function Upload(Request $request)
    {
        $rv = MediaService::Upload($request);
        return response()->json($rv, 200);
    }
}
