<?php

namespace App\Http\Requests;

use App\Rules\ImageExists;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->has('parentId')) {
            return auth()->user()->hasRole('super_admin|admin');
        } else {
            return auth()->user()->hasRole('super_admin');
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'type' => ['required_without:parentId'],
            'parentId' => ['required_without:type', 'exists:categories,id'],
            'name' => ['required', 'min:4'],
            'image' => ['required', new ImageExists($this->image)]
            ,
        ];
    }

    public function messages()
    {
        return ['type.required_without:parentId' => 'type is required unless parentId has value',
            'parentId.required_without:type' => 'parentId is required unless type has value',
            'parentId.exists:categories,id' => 'parent object is not found',
            'name.required' => 'name is required',
            'name.min:4' => 'name length must be at least 4 characters',
            'image.required' => 'image is required',
        ];
    }

}
