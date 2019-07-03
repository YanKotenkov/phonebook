<?php
namespace actions;

use forms\RegisterForm;
use lib\Action;
use lib\http\Request;
use lib\validators\EmailValidator;
use lib\validators\PasswordValidator;
use lib\validators\RequiredValidator;
use lib\validators\StringValidator;
use services\AuthService;

/**
 * Экшн регистрации
 */
class RegisterAction extends Action
{
    /** @var string */
    protected $title = 'Регистрация';
    /** @var string */
    protected $formClass = RegisterForm::class;
    /** @var bool */
    protected $needAuthentication = false;

    /** @inheritdoc */
    public function run(Request $request)
    {
        if ($request->isPost()) {
            $this->form->load($request->body());

            if ($this->validatorRunner->hasErrors()) {
                return $this->render('register', [
                    'registerForm' => $this->form,
                    'errors' => $this->validatorRunner->getErrors(),
                ]);
            }

            $authService = new AuthService($this->form, $this->session->get('captcha'));
            if ($authService->register()) {
                return $this->redirect('/phone-book');
            } else {
                return $this->render('register', ['registerForm' => $this->form, 'errors' => $authService->errors]);
            }
        }

        return $this->render('register', ['registerForm' => $this->form]);
    }

    /** @inheritdoc */
    public function getValidators(Request $request)
    {
        $requiredFields = [];
        foreach ($this->form->getRequiredFields() as $field) {
            $requiredFields[$field] = $request->body($field);
        }

        return [
            new RequiredValidator($requiredFields, $this->form),
            new StringValidator([
                'login' => $request->body('login'),
                'password' => $request->body('password'),
            ], $this->form, [
                'onlyLatin' => true,
            ]),
            new EmailValidator(['email' => $request->body('email')], $this->form),
            new PasswordValidator(['password' => $request->body('password')], $this->form),
        ];
    }
}
