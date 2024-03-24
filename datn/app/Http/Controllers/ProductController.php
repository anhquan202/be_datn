<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

require_once 'c:\xampp\htdocs\be_datn\datn\vendor\autoload.php';
class ProductController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $product = product::with('type')
                ->paginate(10);
            return response()->json($product);
        } else {
            $product = product::find($id);
            if ($product) {
                return response(['data' => $product]);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(ProductRequest $request)
    {
        try {

            $imagePath = Str::random(32) . "." . $request->image->getClientOriginalName();
            $product = product::create([
                'name' => $request->name,
                'cost_in' => $request->cost_in,
                'cost_out' => $request->cost_out,
                'quantity' => $request->quantity,
                'image' => $imagePath,
                'manufacture' => $request->manufacture,
                'type_id' => $request->type_id,
            ]);
            Storage::disk('public')->put($imagePath, file_get_contents($request->image));
            return response(['message' => 'Dữ liệu đã được thêm thành công', 'data' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 500);
        }

    }
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
            } else {
                $imagePath = $product->image; // Khởi tạo imagePath với giá trị hiện tại của hình ảnh
                if ($request->image) {
                    $storage = Storage::disk('public');
                    if ($storage->exists($product->image)) {
                        $storage->delete($product->image);
                    }
                    $imagePath = Str::random(32) . "." . $request->image->getClientOriginalName();
                    $storage->put($imagePath, file_get_contents($request->image));
                }

                $product->update([
                    'name' => $request->name,
                    'cost_in' => $request->cost_in,
                    'cost_out' => $request->cost_out,
                    'quantity' => $request->quantity,
                    'image' => $imagePath,
                    'manufacture' => $request->manufacture,
                    'type_id' => $request->type_id,
                ]);

            }
            return response()->json(['message' => 'Product was successfully updated']);
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
        return response()->json($productsType);
    }

}