<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\Request;

/**
 * Menu CreateRequest.
 */
class CreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:4|unique',
            'parent_id' => 'required',
        ];
    }
}
