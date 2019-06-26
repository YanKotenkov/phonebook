<?php
namespace actions;

use lib\base\Action;
use lib\http\Request;

class AuthAction extends Action
{
    /** @var string */
    protected $title = 'Авторизация';

    /** @inheritDoc */
    public function __invoke(Request $request)
    {
        return $this->render('auth');
    }
}
