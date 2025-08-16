<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'post_id' => 'required|exists:posts,id',
                'content' => 'required|string|max:1000',
                'author' => 'required|string|max:50',
                'is_delete' => 'sometimes|integer|in:0,1'
            ];
        }
        
        return [
            'post_id' => 'sometimes|exists:posts,id',
            'content' => 'required|string|max:1000',
            'author' => 'required|string|max:50',
            'is_delete' => 'sometimes|integer|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => '게시글이 선택되지 않았습니다.',
            'post_id.exists' => '존재하지 않는 게시글입니다.',
            'content.required' => '내용을 입력해주세요.',
            'content.max' => '내용 길이는 최대 1,000자입니다.',
            'author.required' => '작성자를 입력해주세요.',
            'author.max' => '작성자 길이는 최대 50자입니다.',
        ];
    }
}
