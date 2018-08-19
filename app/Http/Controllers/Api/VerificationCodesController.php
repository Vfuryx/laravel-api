<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if (!$captchaData) {
            return $this->response->error('图片验证码已失效', 422);
        }

        if (!hash_equals($captchaData['code'], $request->captcha_code)) {
            // 验证错误就清除缓存
            \Cache::forget($request->captcha_key);
            return $this->response->errorUnauthorized('验证码错误');
        }

        return $this->response->array(['data'=>true])->setStatusCode(200);

    }
}
