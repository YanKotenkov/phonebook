<?php
namespace actions;

use lib\Action;
use lib\http\Request;

/**
 * Экшн для logout'а
 */
class LogoutAction extends Action
{
    /** @var bool */
    protected $needAuthentication = false;

    /** @inheritdoc */
    public function run(Request $request)
    {
        $this->session->destroy();
        return $this->redirect('auth');
    }
}
