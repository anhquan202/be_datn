<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComputersDetailRequest;
use App\Models\computers_detail;
use Illuminate\Http\Request;
use DB;

class ComputersDetailController extends Controller
{
    public function index($id = null)
    {
        $computersDetail = computers_detail::with('product')->paginate(10);
        if ($id === null) {
            return response()->json($computersDetail);
        } else {
            $computersDetail = computers_detail::with('product')->find($id);
            if ($computersDetail) {
                return response(['data' => $computersDetail]);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(ComputersDetailRequest $request)
    {
        try {
            $computersDetail = computers_detail::create($request->all());
            return response(['message' => 'Dữ liệu đã được thêm thành công', 'data' => $computersDetail], 201);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 201);
        }
    }
    public function update($id, ComputersDetailRequest $request)
    {
        try {
            $computersDetail = computers_detail::update($request->all());
            return response(['message' => 'Dữ liệu đã được cập nhật thành công', 'data' => $computersDetail], 201);
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

        $computersDetails = computers_detail::where('CPU', 'like', "%$keyword%")->get();

        return response()->json(['data' => $computersDetails]);
    }
}
