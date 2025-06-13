<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportDataRequest extends FormRequest
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
            'file_info' => 'required|file',
            'file_push_sale' => 'required|file',
            'file_data_product' => 'required|file',
            
            'reporting_date_from' => [
                'required',
                'date_format:"d/m/Y H:i:s"',
            ],
            'reporting_date_to' => [
                'required',
                'date_format:"d/m/Y H:i:s"',
                'after:reporting_date_from',
            ],
            
            'export_receipt_number' => 'nullable|string|max:255',
            'posting_date' => 'required|numeric|in:1,2',
            'submission_reason' => 'required|array|min:1',
            'submission_reason.*' => 'required|string',

            'account_cash_expense_debt' => 'required|string|max:255',
            'account_revenue_credit' => 'required|string|max:255',
            'account_vat_tax' => 'required|string|max:255',
            'account_cost_of_goods_sold' => 'required|string|max:255',
            'account_inventory' => 'required|string|max:255',

            'warehouse_code' => 'required|string|max:255',
            'customer_code' => 'require|string|max:255',


            'trigger_product_name' => 'required|numeric|in:1,2',
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
