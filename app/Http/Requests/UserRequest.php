<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {

        //creat form validation
        if (\Request::route()->getName() == 'admin.user.store') {
            return [
                'name' => ['required', 'string', 'between:3,25'],
                'email' => ['required', 'unique:users,email', 'email'],
                'password' => ['required', 'min:8'],
            ];
        }
        // update form validation
        if (\Request::route()->getName() == 'admin.user.update') {
            $id = $request->id;

            return [
                'name' => ['required', 'string', 'between:7,25'],
                'email' => ['required', 'unique:users,email,' . $id, 'email'],
                'password' => ['nullable', 'min:8'],
            ];
        }

    }
}
