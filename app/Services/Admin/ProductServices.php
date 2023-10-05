<?php

namespace App\Services\Admin;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class ProductServices
{

    public static function create($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
              [
                  'name' => 'required',
                  'price' => 'required',
                  'description' => 'required',
              ]
            );

            if ($validator->fails()){
                return ['status' => 500 , 'errors' => $validator->errors()];
            }
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->image = $request->image ?? null;
            $product->save();
            return['status' => 200, 'msg' => 'Product has been Created successfully.'];

        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }


    public static function list($request)
    {
        try {
            $limit = $request->limit ?? 20;

            $products = Product::with('media')->select('*')
                ->where(
                    function ($q) use ($request) {
                        if (!empty($request->keyword)) {
                            $q->where('name', 'LIKE', '%' . $request->keyword . '%');
                            $q->where('price', 'LIKE', '%' . $request->keyword . '%');
                            $q->orWhere('description', 'LIKE', '%' . $request->keyword . '%');
                        }
                    }
                )
                ->paginate($limit);
            return ['status' => 200, 'data' => $products];
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
                    'price' => 'required',
                    'description' => 'required',
                ]
            );

            if ($validator->fails()){
                return ['status' => 500 , 'errors' => $validator->errors()];
            }
            $product = Product::where('id', $request->id)->first();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->image = $request->image ?? null;
            $product->save();
            return['status' => 200, 'msg' => 'Product has been Updated successfully.'];

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
            Product::whereIn('id', $request->id)->delete();
            return ['status' => 200, 'msg' => 'Product has been deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
