<?php
namespace actions;

use forms\RegisterForm;
use lib\Action;
use lib\http\Request;
use lib\validators\EmailValidator;
use lib\validators\RequiredValidator;
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

            $authService = new AuthService($this->form);
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
        $fields = [];
        foreach ($this->form->getRequiredFields() as $field) {
            $fields[$field] = $request->body($field);
        }

        return [
            new RequiredValidator($fields, $this->form),
            new EmailValidator(['email' => $request->body('email')], $this->form),
        ];
    }
}
