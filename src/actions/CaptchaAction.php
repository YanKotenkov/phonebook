<?php
namespace actions;

use lib\Action;
use lib\captcha\Captcha;
use lib\http\Request;

class CaptchaAction extends Action
{
    /** @var bool */
    protected $needAuthentication = false;

    /** @inheritdoc */
    public function run(Request $request)
    {
        $captcha = new Captcha();
        $code = $captcha->generateRandomCode();
        $captcha->setCookie($code);

        return $this->renderPartial('captcha', compact('captcha', 'code'), null, [
            'Content-Type' => 'image/png',
        ]);
    }
}
