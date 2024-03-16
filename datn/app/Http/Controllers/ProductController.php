<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    //
    public function index($id = null)
    {
        if ($id === null) {
            $product = product::with('type')
            ->paginate(10);
            return response()->json($product);
        } else {
            $product = product::find($id);
            if ($product) {
                return response(['product' => $product]);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(ProductRequest $request)
    {
        try {
            $product = product::create($request->all());
            return response(['message' => 'Dữ liệu đã được thêm thành công', 'data' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
    public function update($id, ProductRequest $request)
    {
        try {
            $product = product::update($request->all());
            return response(['message' => 'Dữ liệu đã được thêm thành công', 'data' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
    public function delete($id)
    {
        try {
            $product = product::find($id);
            if ($product) {
                $product->delete();
                return response(['message' => 'Đã xóa thành công', 'data' => $product], 200);
            } else {
                return response(['error' => 'Không tìm thấy', 'data' => []], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $keyword = $request->input('keyword');

        $products = product::where('name', 'like', "%$keyword%")->get();

        return response()->json(['products' => $products]);
    }
    public function getTypeID(Request $request)
    {
        $typeID = $request->input('typeID');
        $productsType = product::where('type_id', '=', "$typeID")->with('type')->paginate(10);
        return response()->json( $productsType);
    }
}