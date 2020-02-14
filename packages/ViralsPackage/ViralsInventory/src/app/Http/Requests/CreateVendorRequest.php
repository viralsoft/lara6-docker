<?php

namespace ViralsPackage\ViralsInventory\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVendorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'descriptions' => 'nullable|string|max:5000',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'poc_email' => 'nullable|email|max:255',
            'poc_name' => 'nullable|string|max:255',
            'poc_phone' => 'nullable|string|max:255',
        ];
    }
}
