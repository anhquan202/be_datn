<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioDetailRequest;
use App\Models\audio_detail;
use Illuminate\Http\Request;

class AudioDetailController extends Controller
{
    public function index($id = null)
    {

        if ($id === null) {
            $audioDetails = audio_detail::with('product')->paginate(10);
            return response($audioDetails);
        } else {
            $audioDetails = audio_detail::find($id);
            if ($audioDetails) {
                return response($audioDetails);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(AudioDetailRequest $request)
    {
        try {
            $audioDetails = audio_detail::create($request->all());
            return response(['message' => 'Dữ liệu đã được thêm thành công', 'data' => $audioDetails], 201);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 201);
        }
    }
    public function update($id, AudioDetailRequest $request)
    {
        try {
            $audioDetails = audio_detail::update($request->all());
            return response(['message' => 'Dữ liệu đã được cập nhật thành công', 'data' => $audioDetails], 201);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 201);
        }
    }
    public function search(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            $audioDetails = audio_detail::where('type', 'like', "%$keyword%")->get();
            if($audioDetails->isEmpty()){
                return response()->json(['message' => 'Not found data']);
            }else{
                return response()->json(['data' => $audioDetails]);
            }
        } catch (\Exception $error) {
            return response()->json(['error' => $error], 400);
        }
    }
}
