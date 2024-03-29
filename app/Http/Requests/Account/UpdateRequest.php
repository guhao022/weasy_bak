<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Request;

/**
 * Account UpdateRequest.
 */
class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'original_id' => 'required',
            'wechat_account' => 'required',
               ];
    }
}
