<?php
namespace actions;

use Exception;
use lib\base\Action;
use lib\http\Request;

class AuthAction extends Action
{
    /**
     * @param Request $request
     * @return false|mixed|string
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        return $this->render('auth', ['testVar' => 'test']);
    }
}
