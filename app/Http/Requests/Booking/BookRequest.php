<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'order' => ['required'],
            'order.blocks'     => ['required', 'array'],
            'order.booking_at' => ['required', 'date_format:Y-m-d'],
            'order.booking_to' => ['required', 'date_format:Y-m-d']
        ];
    }
}
