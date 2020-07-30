<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
        if (\Request::route()->getName() == 'admin.product.store') {
            return [
                'image' => ['required', 'image'],
                'title' => ['required', 'string', 'between:3,25'],
                'description' => ['required', 'string', 'between:3,250'],

            ];
        }
        // update form validation
        if (\Request::route()->getName() == 'admin.product.update') {
            $id = $request->id;

            return [

                'title' => ['required', 'string', 'between:3,25'],
                'description' => ['required', 'string', 'between:3,250'],

            ];
        }

    }
}
