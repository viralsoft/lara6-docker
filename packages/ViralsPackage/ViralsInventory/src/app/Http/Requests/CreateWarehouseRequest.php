<?php

namespace ViralsPackage\ViralsInventory\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWarehouseRequest extends FormRequest
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
            'name' => 'required|string|unique:warehouses,name|max:255',
            'address' => 'required|string|max:255',
            'store_id' => 'required',
        ];
    }
}
