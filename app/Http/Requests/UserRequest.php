<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {

            $extra = [  
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
        ];

        }
        else {
              $extra = [  
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,'.$this->id],
                'password' => ['string', 'min:8'],
        ];

        }

       $validation = [
            'name' => ['required', 'string', 'max:255'],
            'id'=>'',
            'permissions'=>''
        ];

        return array_merge($validation,$extra);
    }
}
