<?php

namespace ViralsPackage\ViralsInventory\app\Rules;

use Illuminate\Contracts\Validation\Rule;
use ViralsPackage\ViralsInventory\app\Models\Product;
use ViralsPackage\ViralsInventory\app\Models\Warehouse;

class CheckQuantity implements Rule
{
    private $quantity;
    private $product;

    /**
     * Create a new rule instance.
     *
     * @param $quantity
     * @param $product
     */
    public function __construct($quantity, $product)
    {
        $this->quantity = $quantity;
        $this->product = $product;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $data = $this->getProductAndQuantity($this->product, $this->quantity);
        $warehouse = Warehouse::with('products')->where('id', $value)->first();
        if ($warehouse->products && $data) {
            foreach ($data as $key => $value) {
                $productDetail = $warehouse->products->where('id', $key)->first();
                if ($productDetail->pivot->quantity < $value['quantity']) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('virals-inventory::messages.validation.not_enough_product_in_warehouse');
    }

    /**
     * Convert Data
     *
     * @param array $product
     * @param array $quantity
     * @return array
     */
    private function getProductAndQuantity(array $product, array $quantity)
    {
        $dataExport = [];
        foreach ($product as $key => $value)
        {
            if (array_key_exists($value, $dataExport)) {
                $quantityValue = $dataExport[$value]['quantity'] + (float)$quantity[$key];
                $dataExport[$value] = ['quantity' => $quantityValue];
            } else {
                $dataExport[$value] = ['quantity' => (float)$quantity[$key]];
            }
        }
        return $dataExport;
    }
}
