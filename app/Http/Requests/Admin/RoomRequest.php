<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'room_number'  => ['required', 'string', 'max:20', 'unique:rooms,room_number,' . $this->route('room')],
            'room_type_id' => ['required', 'integer', 'exists:room_types,id'],
            'capacity'     => ['required', 'integer', 'min:1'],
            'status'       => ['required', 'in:available,occupied,maintenance'],
            'description'  => ['required', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'facilities'   => ['nullable', 'array'],
            'facilities.*' => ['integer', 'exists:facilities,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'room_number.required'  => 'Nomor kamar wajib diisi.',
            'room_number.unique'    => 'Nomor kamar sudah digunakan.',
            'room_number.max'       => 'Nomor kamar tidak boleh lebih dari 20 karakter.',
            'room_type_id.required' => 'Tipe kamar wajib dipilih.',
            'room_type_id.exists'   => 'Tipe kamar yang dipilih tidak ditemukan.',
            'capacity.required'     => 'Kapasitas kamar wajib diisi.',
            'capacity.min'          => 'Kapasitas minimal 1 orang.',
            'status.required'       => 'Status kamar wajib dipilih.',
            'status.in'             => 'Status kamar tidak valid.',
            'description.required'  => 'Deskripsi kamar wajib diisi.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max'             => 'Ukuran gambar maksimal 2 MB.',
            'facilities.*.exists'   => 'Fasilitas yang dipilih tidak ditemukan.',
        ];
    }
}
