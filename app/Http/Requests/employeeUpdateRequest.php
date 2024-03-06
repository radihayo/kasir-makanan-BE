<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeeUpdateRequest extends FormRequest
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
            'nama' => 'required|max:50|unique:employees,nama,'.\Request::instance()->id,
            'email' => 'required|unique:employees,email,'.\Request::instance()->id,
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'no_telp' => 'required|size:12',
            'alamat' => 'required|max:50'
        ];
    }

    public function messages(): array
    {
        return[
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada',
            'nama.max' => 'Panjang Maksimal 50',
            'no_telp.size' => 'Panjang Maksimal 12'
        ];
    }
}
