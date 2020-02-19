<?php

namespace ViralsPackage\ViralsInventory\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateImportRequest extends FormRequest
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
            'product_id.*' => 'required',
            'vendor_id' => 'required',
            'warehouse_id' => 'required',
            'quantity.*' => 'required|numeric|min:0',
            'date' => 'required',
        ];
    }
}
