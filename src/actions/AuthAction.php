<?php
namespace actions;

use lib\Action;
use lib\http\Request;
use lib\validators\RequiredValidator;
use lib\validators\StringValidator;
use models\User;
use services\AuthService;

class AuthAction extends Action
{
    /** @var string */
    protected $title = 'Авторизация';

    /** @inheritDoc */
    public function run(Request $request)
    {
        $user = new User();

        if ($request->isPost()) {
            $user->login = $request->body('login');
            $user->password = $request->body('password');

            if ($this->validatorRunner->hasErrors()) {
                return $this->render('auth', ['user' => $user, 'errors' => $this->validatorRunner->getErrors()]);
            }

            $authService = new AuthService($user);
            if ($authService->login()) {
                $this->redirect('/');
            }
        }

        return $this->render('auth', ['user' => $user]);
    }

    /** @inheritDoc */
    public function getValidators(Request $request)
    {
        return [
            new StringValidator([
                'login' => $request->body('login'),
                'password' => $request->body('password'),
            ], new User()),
            new RequiredValidator([
                'login' => $request->body('login'),
                'password' => $request->body('password'),
            ], new User()),
        ];
    }
}
