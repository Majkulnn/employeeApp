<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'address' => ['required'],
            'department_id' => ['required'],
            'city_id' => ['required'],
            'state_id' => ['required'],
            'country_id' => ['required'],
            'zip_code' => ['required'],
            'birthdate' => ['required'],
            'date_hired' => ['required'],
        ];
    }
}
