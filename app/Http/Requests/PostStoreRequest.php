<?php

namespace App\Http\Requests;

use App\Dtos\PostStoreDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'body' => 'string',
        ];
    }

    public function data(): PostStoreDto
    {
        return new PostStoreDto([
            'title' => $this->input('title'),
            'body' => $this->input('body'),
            'user_id' => (int) Auth::user()->getKey(),
        ]);
    }
}
