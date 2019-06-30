<?php
namespace actions;

use lib\Action;
use lib\http\Request;
use lib\validators\RequiredValidator;
use services\AuthService;
use forms\UserForm;

/**
 * Экшн аутентификации
 */
class AuthAction extends Action
{
    /** @var string */
    protected $title = 'Вход';
    /** @var string */
    protected $formClass = UserForm::class;
    /** @var bool */
    protected $needAuthentication = false;

    /** @inheritDoc */
    public function run(Request $request)
    {
        if ($request->isPost()) {
            $this->form->load($request->body());

            if ($this->validatorRunner->hasErrors()) {
                return $this->render('auth', ['user' => $this->form, 'errors' => $this->validatorRunner->getErrors()]);
            }

            $authService = new AuthService($this->form);
            if ($authService->login()) {
                $this->redirect('/');
            } else {
                return $this->render('auth', ['user' => $this->form, 'errors' => $authService->errors]);
            }
        }

        return $this->render('auth', ['user' => $this->form]);
    }

    /** @inheritDoc */
    public function getValidators(Request $request)
    {
        $userForm = new UserForm();
        return [
            new RequiredValidator([
                'login' => $request->body('login'),
                'password' => $request->body('password'),
            ], $userForm),
        ];
    }
}
