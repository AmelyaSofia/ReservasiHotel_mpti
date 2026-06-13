<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('facilities')->ignore($this->route('facility'))],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama fasilitas wajib diisi.',
            'name.max'      => 'Nama fasilitas tidak boleh lebih dari 100 karakter.',
            'name.unique'   => 'Fasilitas dengan nama ini sudah ada.',
        ];
    }
}
