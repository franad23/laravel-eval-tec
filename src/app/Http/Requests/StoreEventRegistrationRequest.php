<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'lastname' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255|min:6|unique:event_registrations,email',
            'dni' => 'required|numeric|digits_between:2,10|unique:event_registrations,dni',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'lastname' => trim($this->lastname),
            'email' => trim($this->email),
            'dni' => trim($this->dni),
        ]);
    }

    public function messages()
{
    return [
        'name.required' => 'El nombre es obligatorio',
        'name.min' => 'El nombre debe tener al menos 2 caracteres',
        'name.max' => 'El nombre no debe superar los 255 caracteres',

        'lastname.required' => 'El apellido es obligatorio',
        'lastname.min' => 'El apellido debe tener al menos 2 caracteres',
        'lastname.max' => 'El apellido no debe superar los 255 caracteres',

        'email.required' => 'El email es obligatorio',
        'email.email' => 'El email es invalido',
        'email.min' => 'El email debe tener al menos 6 caracteres',
        'email.max' => 'El email no debe superar los 255 caracteres',
        'email.unique' => 'El email ya existe',

        'dni.required' => 'El dni es obligatorio',
        'dni.numeric' => 'El dni debe ser numérico',
        'dni.digits_between' => 'El dni debe tener entre 2 y 10 dígitos',
        'dni.unique' => 'El dni ya existe',
    ];
}
}
