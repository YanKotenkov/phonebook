<?php
namespace actions;

use lib\Action;
use lib\http\Request;
use models\User;
use services\AuthService;

class AuthAction extends Action
{
    /** @var string */
    protected $title = 'Авторизация';

    /** @inheritDoc */
    public function __invoke(Request $request)
    {
        $user = new User();

        if ($request->isPost()) {
            $user->login = $request->body('login');
            $user->password = $request->body('password');

            $authService = new AuthService($user);
            if ($authService->login()) {
                $this->redirect('/');
            }
        }

        return $this->render('auth', ['user' => $user]);
    }
}
