<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [
            'name' => ['required'],
            'description' => ['required'],
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['status'] = ['required', 'in:active,completed'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Укажите название задачи',
            'description.required' => 'Укажите описание  задачи'
        ];
    }
}
