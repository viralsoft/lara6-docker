<?php

namespace ViralsPackage\ViralsInventory\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ViralsPackage\ViralsInventory\app\Rules\CheckQuantity;

class CreateExportRequest extends FormRequest
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
        $product = request()->input('product_id');
        $quantity = request()->input('quantity');
        return [
            'product_id.*' => 'required',
            'warehouse_id' => ['required',  new CheckQuantity($quantity, $product)],
            'quantity.*' => 'required|numeric|min:0',
            'date' => 'required',
        ];
    }
}
