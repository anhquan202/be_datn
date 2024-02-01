<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|regex:/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ',
            'phone' => 'required|string|max:10|regex:/(0[3|5|7|8|9])+([0-9]{8})\b/',
            'gender' => 'required|string',
            'email' => 'required|string|unique|max:50|regex:',
            'password' => 'required|string|min:6|max:20'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên khách hàng không được để trống!',
            'name.regex' => 'Vui lòng nhập tên khách hàng đúng định dạng!',
            'phone.required' => 'SĐT không được để trống!',
            'phone.regex' => 'SDT không phù hợp theo định dạng VN!',
            'gender.required' => 'Giới tính không được để trống!',
            'email.required' => 'Email không được để trống!',
            'email.unique' => 'Email đã tồn tại!',
            'email.regex' => 'Email không đúng định dạng!',
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự!',
            'pasword.max' => 'Mật khẩu tối đa 20 kí tự'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
