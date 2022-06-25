<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
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
        $volume_between = 'between:' . env('API_BOOKING_VOLUME_MIN',1)
            . ',' . env('API_BOOKING_VOLUME_MAX',999999);

        $temp_between = 'between:' . env('API_BOOKING_TEMP_MIN',-99)
            . ',' . env('API_BOOKING_TEMP_MAX',0);

        return [
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'volume' => ['required', 'integer', $volume_between],
            'temp' => ['required', 'integer', $temp_between]
        ];
    }
}
