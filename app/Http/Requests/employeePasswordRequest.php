<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Match_Password;

class employeePasswordRequest extends FormRequest
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
            'old_password' => ['required', new Match_Password],
            'new_password'   => 'required|min:8|same:re_new_password',
            're_new_password'   => 'required|min:8|same:new_password'
        ];
    }
    public function messages(): array
    {
        return[
            'required' => 'Inputan Tidak Boleh Kosong',
            'same' => 'Password Baru Dengan Re-Type Password Baru Harus Sama',
            'min' => 'Panjang Password Minimal 8 Karakter'
        ];
    }
}
