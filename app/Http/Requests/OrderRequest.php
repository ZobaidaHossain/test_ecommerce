<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'=>'nullable',
            'quantity'=>'nullable',
            'status'=>'nullable',
        ];
    }
}
