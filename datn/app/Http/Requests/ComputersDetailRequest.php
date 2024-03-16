<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class ComputersDetailRequest extends FormRequest
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
          'type'=> 'required|string',
          'CPU'=> 'required|string',
          'ram' => 'required|string',
          'storage' => 'required|string',
          'graphics' => 'required|string',
          'operating_system' => 'required|string',
          'decription' => 'string'
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
