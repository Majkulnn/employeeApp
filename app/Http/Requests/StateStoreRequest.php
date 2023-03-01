<?php

namespace App\Http\Requests;

use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;

class StateStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_id' => ['required'],
            'name' => ['required','string','max:255',]
        ];
    }
}
