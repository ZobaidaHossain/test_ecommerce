<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id'=>'nullable',
            'name'=>'nullable',
            'email'=>'nullable',
            'password'=>'nullable',
        ];
    }
}
