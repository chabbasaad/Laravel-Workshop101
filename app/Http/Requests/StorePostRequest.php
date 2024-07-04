<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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

                'title' => 'required|min:4|max:100',
                'content' => 'required|min:10',
                // min_height=100,max_width=1000,max_height=1000
                'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100'

        ];
    }
}
