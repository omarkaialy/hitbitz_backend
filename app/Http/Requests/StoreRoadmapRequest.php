<?php

namespace App\Http\Requests;

use App\Rules\ImageExists;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoadmapRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(['super_admin','admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4', 'unique:roadmaps,name'],
            'image' => ['required', new ImageExists($this->image)],
            'categoryId' => 'required|exists:categories,id',
            'description' => 'required|min:10'
        ];
    }

    public function messages()
    {
        return [
            'name.unique:roadmaps,name' => 'name has already been taken',
            'name.required' => 'name is required',
            'name.min:4' => 'name length should at least be 4 character',
            'image.required' => 'image is required',
            'categoryId.required' => 'categoryId is required',
            'categoryId.exists:categories,id' => 'category is not exists',
            'description.max:20' => 'description should be at least 20 character',
            'description.required' => 'description is required',
        ];
    }
}
