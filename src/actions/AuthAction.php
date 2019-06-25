<?php
namespace actions;

use lib\base\Action;
use lib\http\Request;

class AuthAction extends Action
{
    /** @inheritDoc */
    public function __invoke(Request $request)
    {
        return $this->render('auth', ['testVar' => 'test']);
    }
}
