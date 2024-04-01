<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SubadminCreateRequest extends FormRequest
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
            'name'   => ['required','string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'unique:users'],
            'number'  => ['required', 'unique:users'],
            'whats_app'   => ['required'],
            'member_id'   => ['nullable'],
            'gender'   => ['nullable'],
            'email_verified_at'   => ['nullable'],
            'subadmintype_id'   => ['required','integer'],
            // 'managment_id'   => ['nullable','integer'],
            'image'   => ['nullable','mimes:png,jpg,webp,jpeg'],
            'country'   => ['nullable'],
            'language'   => ['nullable'],
            'password' => ['required','min:8','confirmed'],
        ];
    }
}
