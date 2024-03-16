<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class PhoneDetailRequest extends FormRequest
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
            'color' => 'required',
            'camera' => 'required',
            'screen' => 'required',
            'operating_system' => 'required',
            'ram' => 'required',
            'rom' => 'required',
            'product_id' => 'required'
        ];
    }
    public function messages(){
        return [
            'color.required' => 'Không được để trống',
            'camera.required' => 'Không được để trống',
            'screen' => 'Không được để trống',
            'operating_system' => 'Không được để trống',
            'ram' => 'Không được để trống',
            'rom' => 'Không được để trống',
            'product_id' => 'Không được để trống',
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
