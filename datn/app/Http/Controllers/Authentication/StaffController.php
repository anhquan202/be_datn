<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function login(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $staff = Staff::where('email', $email)->first();
            if (!$staff) {
                return response()->json(['error' => 'Email không tồn tại'], 404);
            }
            if ($staff->password !== hash('sha256', $password)) {
                return response()->json(['error' => 'Mật khẩu không chính xác'], 401);
            }

            return response()->json(['staff' => $staff], 200);

        } catch (\Exception $error) {

            return response()->json(['message' => $error->getMessage()], 401);
        }
    }

}
