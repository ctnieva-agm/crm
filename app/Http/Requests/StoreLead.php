<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLead extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /* public function authorize()
    {
        return false;
    } */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "sales_id" => "required",
            "stage" => "required",
            "client_name" => "required",
            "company_name" => "required",
            "deal_amount" => "required",
            "expected_close_date" => "required",
            "closed_amount" => "required_if:stage,win",
            "actual_close_date" => "required_if:stage,win,delivery",
            "source" => "required",
            "customer_type" => "nullable",
            "product_id" => "required",
            "add_ons" => "nullable",
            "potential_competitor" => "nullable",
            "lose_notes" => "nullable",
            "extra_notes" => "nullable",
        ];
    }

    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }
    }

    public function messages()
    {
        return [
            'sales_id.required' => 'The salesperson field is required',
            'product_id.required' => 'The product field is required',
        ];
    }
}
