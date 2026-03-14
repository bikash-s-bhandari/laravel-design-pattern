<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\DTOs\RegisterUserDTO;
use Illuminate\Support\Facades\Hash;


class RegisterUserRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', 'min:8', Password::defaults()],
        ];
    }

     /*
    |--------------------------------------------------------------------------
    | prepareForValidation()
    |--------------------------------------------------------------------------
    | Validation run हुनु भन्दा पहिले execute हुन्छ
    | Input normalize गर्न use गरिन्छ
    */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => ucwords($this->name),
            'email' => strtolower($this->email),
        ]);
    }

     /*
    |--------------------------------------------------------------------------
    | Convert request to DTO
    |--------------------------------------------------------------------------
    */
    public function toDto(): RegisterUserDto
    {
        return new RegisterUserDto(
            name: $this->validated('name'),
            email: $this->validated('email'),
            password: Hash::make($this->validated('password')),
        );
    }
}
