<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index($id = null){
        if ($id == null){
            $customer = customer::paginate(10);
            return response($customer);
        }else{
            $customer = customer::find($id);
            if($customer){
                return response(['data' => $customer]);
            }else{
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(CustomerRequest $request)
    {
        try {
            $customer = customer::create($request->all());
            return response(['message' => 'Dữ liệu đã được thêm thành công', 'data' => $customer], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $customers = customer::where('name', 'like', "%$keyword%")->get();

        return response()->json(['data' => $customers]);
    }
    
}
