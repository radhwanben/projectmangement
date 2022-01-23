<?php

namespace App\Http\Requests;

use App\Models\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_create');
    }

    public function rules()
    {
        return [
            'nom' => [
                'string',
                'required',
            ],
            'categorie' => [
                'string',
                'nullable',
            ],
            'deadline' => [
                'required',
                'date_format:' . 'Y-m-d',
            ],
        ];
    }
}