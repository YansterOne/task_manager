<?php

namespace App\Http\Requests;

use Core\User\Requests\LoginUserRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements LoginUserRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }

    public function getUsername(): string
    {
        return $this->get('username');
    }

    public function getPassword(): string
    {
        return $this->get('password');
    }
}
