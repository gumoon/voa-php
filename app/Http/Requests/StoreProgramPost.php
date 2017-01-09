<?php

namespace voa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 验证登录用户是否有权限更新资源
     * @return bool
     */
    public function authorize()
    {
        //待加，非后台有权限用户，不让操作。
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'intro' => 'required',
            'type' => 'in:0,1,2,3',
            'status' => 'in:0,1,99',
        ];
    }
}
