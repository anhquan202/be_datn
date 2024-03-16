<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class AudioDetailRequest extends FormRequest
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
            'type' => 'required|string',
            'connectivity' => 'required|string',
            'color' => 'required|string',
            'drive_size' => 'string',
            'cable_length' => 'string',
            'charing_time' => 'float',
            'usage_time' => 'float',
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
