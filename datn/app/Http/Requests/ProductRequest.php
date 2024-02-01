<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
class ProductRequest extends FormRequest
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
            //
            'name' => 'required|string|max:300|regex:/^[A-Za-z0-9]+(?:[-\s][A-Za-z0-9]+)*$/',
            'cost_in' => 'required|integer',
            'cost_out' => 'required|integer',
            'image' => 'required|string|max:300',
            'quantity' => 'required|integer',
            'manufacture' => 'required|string|max:300',
            'type_id' => [
                'required',
                'integer',
                Rule::exists('type', 'id')
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.regex' => 'Tên sản phẩm không được chứa kí tự đặc biệt',
            'cost_in.required' => 'Giá nhập không được để trống',
            'cost_in.integer' => 'Dữ liệu nhập không hợp lệ, vui lòng nhập lại',
            'cost_out.integer' => 'Vui lòng nhập lại giá bán của sản phẩm',
            'cost_out.required' => 'Giá bán không được để trống',
            'image.required' => 'Ảnh sản phẩm không được để trống',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'quantity.integer' => 'Dữ liệu nhập không hợp lệ, vui lòng nhập lại',
            'manufacture.required' => 'Hãng sản xuất không được để trống',
            'type_id.required' => 'Loại sản phẩm không được để trống',
            
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
