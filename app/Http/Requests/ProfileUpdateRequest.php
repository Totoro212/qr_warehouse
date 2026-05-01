<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения.',
            'name.max' => 'Имя не должно быть длиннее 255 символов.',
            
            'email.required' => 'Email обязателен для заполнения.',
            'email.email' => 'Пожалуйста, введите корректный email адрес.',
            'email.unique' => 'Этот email уже занят другим пользователем.',
            'email.max' => 'Email не должен быть длиннее 255 символов.',
        ];
    }
}
