<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneDetailRequest;
use App\Models\phone_detail;
use DB;
use Illuminate\Http\Request;

class PhoneDetailController extends Controller
{
    public function index($id = null)
    {
        $phoneDetail = phone_detail::with('product')->paginate(10);
        if ($id === null) {
            return response($phoneDetail);
        } else {
            $phoneDetail = phone_detail::with('product')->find($id);
            if ($phoneDetail) {
                return response(['data' => $phoneDetail]);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(PhoneDetailRequest $request)
    {
        try {
            $phoneDetail = phone_detail::create($request->all());
            return response(['data' => $phoneDetail], 201);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 201);
        }
    }
    public function update($id, PhoneDetailRequest $request)
    {
        try {
            $phoneDetail = phone_detail::update($request->all());
            return response(['message' => 'Dữ liệu đã được cập nhật thành công', 'data' => $phoneDetail], 201);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 201);
        }
    }
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $keyword = $request->input('keyword');

        $phoneDetails = phone_detail::where('name', 'like', "%$keyword%")->get();

        return response()->json(['data' => $phoneDetails]);
    }
}
