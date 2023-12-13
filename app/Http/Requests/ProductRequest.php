<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'image' => ['required', 'image','max:5000'],
        ];

        }
        else {
              $extra = [  
                'image' => ['image','max:5000'],
        ];

        }

        $validation = [
            'name' => ['required', 'string', 'max:255'],
            'keys'=>'',
            'values'=>'',
            'apperance'=>'',
        
        ];

        return array_merge($validation,$extra);
    }
}
