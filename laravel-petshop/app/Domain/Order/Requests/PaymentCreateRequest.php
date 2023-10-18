<?php

namespace App\Domain\Order\Requests;

use App\Domain\Order\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;

class PaymentCreateRequest extends FormRequest
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
            'type' => ['required', 'in:'.implode(',', Payment::PAYMENT_TYPE)],
            'details.holder_name' => ['required_if:type,'.Payment::CREDIT_CARD, 'string'],
            'details.number' => ['required_if:type,'.Payment::CREDIT_CARD, 'string'],
            'details.ccv' => ['required_if:type,'.Payment::CREDIT_CARD, 'integer'],
            'details.expire_date' => ['required_if:type,'.Payment::CREDIT_CARD, 'string'],
            'details.first_name' => ['required_if:type,'.Payment::CASH_ON_DELIVERY, 'string'],
            'details.last_name' => ['required_if:type,'.Payment::CASH_ON_DELIVERY, 'string'],
            'details.address' => ['required_if:type,'.Payment::CASH_ON_DELIVERY, 'string'],
            'details.swift' => ['required_if:type,'.Payment::BANK_TRANSFER, 'string'],
            'details.iban' => ['required_if:type,'.Payment::BANK_TRANSFER, 'string'],
            'details.name' => ['required_if:type,'.Payment::BANK_TRANSFER, 'string'],
        ];
    }
}
