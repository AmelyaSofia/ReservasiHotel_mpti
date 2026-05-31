<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:100'],
            'description'     => ['required', 'string'],
            'price_per_night' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'            => 'Nama tipe kamar wajib diisi.',
            'name.max'                 => 'Nama tipe kamar tidak boleh lebih dari 100 karakter.',
            'description.required'     => 'Deskripsi tipe kamar wajib diisi.',
            'price_per_night.required' => 'Harga per malam wajib diisi.',
            'price_per_night.numeric'  => 'Harga per malam harus berupa angka.',
            'price_per_night.min'      => 'Harga per malam minimal Rp 1.',
        ];
    }
}
