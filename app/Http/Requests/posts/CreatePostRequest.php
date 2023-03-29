<?php

namespace App\Http\Requests\posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|min:4|max:35|unique:posts,title',
            'description'=>'required',
            'content'=>'required',
            'image'=>'required|image',
            'published_at'=>'required|date',
            'category_id'=>'required',
        ];
    }
}
