<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('is_admin');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
        ];
    }
}
