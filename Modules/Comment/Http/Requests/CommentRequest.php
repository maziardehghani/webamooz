<?php

namespace Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Comment\Rules\commentableRule;
use Modules\Comment\Rules\ValidCommentId;

class CommentRequest extends FormRequest
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
            'body' => 'required',
            'commentable_id' => 'required',
            'commentable_type' => ['required' , new commentableRule()],
            'comment_id' => ['nullable' , new ValidCommentId()]
        ];
    }
}
