<?php

namespace App\Http\Controllers;
use App\Models\type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function show($id = null){
        if ($id == null) {
            $type = type::all();
            return response(['data' => $type]);
        } else {
            $type = type::find($id);
            if ($type) {
                return response(['type' => $type]);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
}
