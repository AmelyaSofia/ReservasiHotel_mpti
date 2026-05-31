<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'room_id'        => ['required', 'integer', 'exists:rooms,id'],
            'check_in_date'  => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.required'              => 'Kamar wajib dipilih.',
            'room_id.exists'                => 'Kamar yang dipilih tidak ditemukan.',
            'check_in_date.required'        => 'Tanggal check-in wajib diisi.',
            'check_in_date.date'            => 'Format tanggal check-in tidak valid.',
            'check_in_date.after_or_equal'  => 'Tanggal check-in tidak boleh sebelum hari ini.',
            'check_out_date.required'       => 'Tanggal check-out wajib diisi.',
            'check_out_date.date'           => 'Format tanggal check-out tidak valid.',
            'check_out_date.after'          => 'Tanggal check-out harus setelah tanggal check-in.',
        ];
    }
}
