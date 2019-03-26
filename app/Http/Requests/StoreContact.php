<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
            'full_name' => 'required|max:55',
            'email' => 'required|email',
            'system_id' => 'required',
            'phone_number' => 'required|numeric',
            'birthday' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'system_id' => 'required',
            'source' => 'required',
            'company_name' => 'required_with:position,company_address,',
            'position' => 'required_with:company_name,company_address,',
            'company_address' => 'required_with:position,company_name,',
            'sponsored_by' => 'nullable',
            'notes' => 'nullable',
        ];
    }

    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }
    }
}
