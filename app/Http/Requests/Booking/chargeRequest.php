<?php

namespace App\Http\Requests\Booking;

use App\Services\BookingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Validator;
use Stripe\Exception\InvalidRequestException;

class chargeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required|string'
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $stripeService = new BookingService();
            try {
                $stripeService->stripe->products->retrieve($this->product_id);
            } catch (InvalidRequestException $exception) {
                $validator->errors()->add('product_id', $exception->getMessage());
            }

        });
    }

}
