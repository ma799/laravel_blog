<?php

namespace App\Http\Requests\categories;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
class UpdateCategoryRequest extends FormRequest
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
        $category = $this->route('category');
        return [
            'name'=>'required|min:4|max:25|unique:categories,name,'.$category->id,
        ];
    }
}