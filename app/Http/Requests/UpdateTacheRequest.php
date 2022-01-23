<?php

namespace App\Http\Requests;

use App\Models\Tache;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTacheRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tache_edit');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'required',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
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