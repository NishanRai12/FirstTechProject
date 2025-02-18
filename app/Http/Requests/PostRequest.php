<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'caption' =>['max:60'],
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags.*' => 'distinct|min:3'
        ];
    }
//    public function attributes(): array{{
//        return [
////            'caption.max' => 'Maximum 60 characters allowed',
////            'post_image.image' => 'File must be an image type',
////            'post_image.mimes' => 'File must be a file of type: jpeg, png, jpg',
//            'post_image.required' => 'Image cannot be null',
////            'post_image.max' => 'Maximum 60 characters allowed',
////            'tags.min' => 'Minimum 3 tags allowed',
////            'tags.*.distinct' => 'Only one tag is allowed'
//        ];
//    }
public function attributes(): array{
        return [
            'tags.*' => 'tag'
        ];
}
}
