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
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required',
            'availableSeats' => 'required',
            'takenSeats' => 'nullable', 
            
            'reservationMethod' =>'required',
            'category_id' => 'required',
            'organizer_id' => 'required',
            'image' => 'nullable', 
        ];
    }
}
