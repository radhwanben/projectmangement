<?php

namespace App\Http\Requests;

use App\Models\Tache;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTacheRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tache_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'required',
            ],
            'date' => [
                'date_format:' . 'Y-m-d',
                'nullable',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'array',
            ],
            'projects.*' => [
                'integer',
            ],
            'projects' => [
                'array',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}