<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'availableSeats' => 'required|integer|min:0',
            'takenSeats' => 'nullable|integer|min:0', 
            'status' => [
                'required',
                Rule::in(['draft', 'published', 'cancelled']), 
            ],
            'reservationMethod' => [
                'required',
                Rule::in([0, 1]), 
            ],
            'category_id' => 'required|exists:categories,id',
            'organizer_id' => 'required|exists:organizers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }
}
