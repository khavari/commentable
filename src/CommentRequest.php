<?php

namespace Easteregg\Comment;

use Illuminate\Foundation\Http\FormRequest as Request;

class CommentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body'           => ['required', 'min:3'],
            'commentable_id' => ['numeric'],
        ];
    }
}
