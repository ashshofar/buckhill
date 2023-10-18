<?php

namespace App\Domain\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'order_status_uuid' => ['required', 'string', 'exists:order_statuses,uuid'],
            'payment_uuid' => ['required', 'string', 'exists:payments,uuid'],
            'products' => ['required', 'array'],
            'products.*.uuid' => ['required_with:products', 'string', 'exists:products,uuid'],
            'products.*.quantity' => ['required_with:products', 'integer'],
            'address' => ['required', 'array'],
            'address.billing' => ['required_with:address', 'string'],
            'address.shipping' => ['required_with:address', 'string']
        ];
    }
}
