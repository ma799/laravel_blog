<?php

namespace App\Http\Requests\posts;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class UpdatePostRequest extends FormRequest
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
        $post = $this->route('post');
        return  [
            'title'=>'required|min:4|max:35|unique:posts,title,'.$post->id,
            'description'=>'required',
            'content'=>'required',
            'category_id'=>'required',
        ];
    }
}
