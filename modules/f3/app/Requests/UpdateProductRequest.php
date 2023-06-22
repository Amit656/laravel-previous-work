<?php

namespace Modules\Product\App\Requests;

use Modules\Vendor\App\Rules\CurrencyCheckRule;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class UpdateProductRequest extends StoreProductRequest
{
    use STEncodeDecodeTrait;

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
        $rules = parent::rules();
        //override name rules for edit
        $rules['name'] = 'required|string|max:50|unique:products,name,'.$this->product->id.',id,warehouse_id,'.$this->warehouse_id;
        $rules['sku'] = 'required|string|max:255|unique:products,sku,'.$this->product->id.',id,three_pl_customer_id,'.$this->decodeHashValue($this->product->three_pl_customer_id);
        $rules['status'] = 'required|boolean';
        $rules['weight'] = 'nullable|numeric|between:0,99999999.99';
        $rules['height'] = 'nullable|numeric|between:0,99999999.99';
        $rules['width'] = 'nullable|numeric|between:0,99999999.99';
        $rules['length'] = 'nullable|numeric|between:0,99999999.99';
        $rules['custom_value'] = 'nullable|numeric|between:0,99999999.99';
        $rules['custom_description'] = 'nullable|string|max:255';
        $rules['price'] = 'nullable|numeric|between:0,99999999.99';
        $rules['reserve'] = 'nullable|integer';
        $rules['reorder_amount'] = 'nullable|integer';
        $rules['reorder_level'] = 'nullable|integer';
        $rules['replenishment_level'] = 'nullable|integer';
        $rules['item_count_full'] = 'nullable|boolean';
        $rules['country_of_manufacturer'] = 'nullable|integer';
        $rules['currency'] = ['nullable', 'integer', new CurrencyCheckRule];
        $rules['tarrif_code'] = 'nullable|integer';
        $rules['tags'] = 'nullable|array';
        $rules['tags.*'] = 'string';
        $rules['final_sale_item'] = 'nullable|boolean';
        $rules['cycle_count'] = 'nullable|boolean';
        $rules['add_to_invoice'] = 'nullable|boolean';
        $rules['dont_show_on_custom_form'] = 'nullable|boolean';
        $rules['assembly_sku'] = 'nullable|boolean';
        $rules['dropship_only'] = 'nullable|boolean';
        $rules['need_serial_number'] = 'nullable|integer';
        $rules['lithium_ion'] = 'nullable|boolean';
        $rules['is_virtual'] = 'nullable|boolean';
        $rules['dangerous_goods_code'] = 'nullable|integer';
        $rules['auto_fulfill'] = 'nullable|boolean';
        $rules['auto_pack'] = 'nullable|boolean';
        $rules['product_note'] = 'nullable|string|max:255';
        $rules['product_packer_note'] = 'nullable|string|max:255';
        $rules['product_return_note'] = 'nullable|string|max:255';

        return $rules;
    }
}
