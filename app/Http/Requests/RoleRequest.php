<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the role is authorized to make this request.
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
    public function rules(Request $request)
    {

        //creat form validation
        if (\Request::route()->getName() == 'admin.role.store') {
            return [
                'name' => ['required', 'string', 'between:3,25', 'unique:roles,name'],
                'permissions' => ['required'],
                'permissions.*' => ['required'],
            ];
        }
        // update form validation
        if (\Request::route()->getName() == 'admin.role.update') {
            $id = $request->id;

            return [
                'name' => ['required', 'string', 'between:3,25', 'unique:roles,name,' . $id],
                'permissions' => ['required'],
                'permissions.*' => ['required'],
            ];
        }

    }
}
