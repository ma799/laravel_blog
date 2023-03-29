<?php

namespace App\Http\Requests\tags;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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

            $tag = $this->route('tag');
            return [
            'name'=>'required|min:4|max:25|unique:tags,name,'.$tag->id,
        ];
    }
}
