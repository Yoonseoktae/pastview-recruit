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
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
            'author' => 'required|string|max:50',
            'is_delete' => 'sometimes|integer|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '제목을 입력해주세요.',
            'title.max' => '제목의 최대 길이는 255자입니다.',
            'content.required' => '내용을 입력해주세요.',
            'content.max' => '내용의 최대 길이는 10,000자입니다.',
            'author.required' => '작성자를 입력해주세요.',
            'author.max' => '작성자의 최대 길이는 50자입니다.',
        ];
    }
    
}
