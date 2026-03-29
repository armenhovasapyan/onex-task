<?php

namespace App\Http\Requests;

use App\Enums\ReservationStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return ValidationRule
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:' . ReservationStatus::CONFIRMED->value . ',' . ReservationStatus::CANCELED->value,
            'book_id' => 'required|integer|exists:books,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
