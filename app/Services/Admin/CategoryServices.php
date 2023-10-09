<?php

namespace App\Services\Admin;

use App\Models\Categories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class CategoryServices
{

    public static function create($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $category = new Categories();
            $category->name = $request->name;
            $category->save();
            return ['status' => 200, 'msg' => 'Category has been Created successfully.'];

        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }


    public static function list($request)
    {
        try {
            $limit = $request->limit ?? 20;

            $category = Categories::select('*')
                ->where(
                    function ($q) use ($request) {
                        if (!empty($request->keyword)) {
                            $q->where('name', 'LIKE', '%' . $request->keyword . '%');
                        }
                    }
                )
                ->paginate($limit);
            return ['status' => 200, 'data' => $category];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }




    public static function update($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $category = Categories::where('id', $request->id)->first();
            $category->name = $request->name;
            $category->save();
            return ['status' => 200, 'msg' => 'Category has been Updated successfully.'];

        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function delete($request)
    {

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                ]
            );

            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            Categories::whereIn('id', $request->id)->delete();
            return ['status' => 200, 'msg' => 'Category has been deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
