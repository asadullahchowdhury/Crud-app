<?php

namespace App\Http\Controllers;

use App\Services\Admin\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $rv = CategoryServices::create($request);
        return response()->json($rv, 200);
    }


    public function list(Request $request)
    {
        $rv = CategoryServices::list($request);
        return response()->json($rv, 200);
    }

    public function update(Request $request)
    {
        $rv = CategoryServices::update($request);
        return response()->json($rv, 200);
    }

    public function delete(Request $request)
    {
        $rv = CategoryServices::delete($request);
        return response()->json($rv, 200);
    }
}
