<?php

namespace App\Http\Requests;


class MessageRequest extends BaseRequest
{
    protected $rules_send = [
        'mobile'   =>  [
            'required',
            'regex:/^1\d{10}$/',
            'unique:student_user,phone',
        ],
        'platform' => 'required|int',
        'key'      => 'required|string',
        'captcha'  => 'required|string',
    ];

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
     * @Describe  [Back the Chinese error instruction]
     * @Author    George
     * @return array
     * @Version   1.0
     * @DateTime: 2018/8/7T11:25+0800
     */
    public function messages(){
        return[
            'mobile.regex'  => 'common.phone.invalid',
            'mobile.unique' => 'student.message.mobile_registered',
        ];
    }
}
