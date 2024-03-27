<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
class InvoiceRequest extends FormRequest
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
            'receiver_address' => 'required|string|max:200',
            'receiver_phone' => 'nullable|string|max:10',
            'total_amount' => 'required|numeric',
            'customer_id' => 'required|exists:customer,id',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
        ];
    }
    public function messages(){
        return [
            'receiver_address.required' => 'Địa chỉ nhận là bắt buộc',
            'receiver_phone.required' => 'SĐT là bắt buộc',
            'total_amount.required' => 'Tổng tiền là bắt buộc',
            'customer_id.required' => 'Vui lòng chọn tên KH',
            'details.required' => 'Vui lòng nhập hàng hóa'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $errorMessages = [];

        foreach ($errors as $key => $messages) {
            $errorMessages[$key] = $messages[0]; // Lấy thông báo lỗi đầu tiên cho mỗi trường
        }
        throw new HttpResponseException(response()->json([
            'error' => $errorMessages,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
