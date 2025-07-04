<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownLoadExportViettelPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
       return [
            'export_instance_id' => 'required|string|max:40',
            'arr_delivery_code_export_sale' => 'sometimes|array',
            'arr_delivery_code_export_sale.*' => 'string',
            'arr_delivery_code_export_service' => 'sometimes|array',
            'arr_delivery_code_export_service.*' => 'string',
            'shipping_service_tax' => 'integer|in:8,10',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
