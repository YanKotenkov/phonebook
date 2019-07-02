<?php
namespace actions;

use forms\ContactForm;
use lib\Action;
use lib\http\Request;
use lib\http\Response;
use lib\validators\EmailValidator;
use lib\validators\ImageValidator;
use lib\validators\PhoneValidator;
use lib\validators\RequiredValidator;
use lib\validators\StringValidator;
use models\Contact;
use services\ContactService;

/**
 * Экшн добавления контакта
 */
class AddContactAction extends Action
{
    /** @var string */
    protected $formClass = ContactForm::class;

    /** @inheritDoc */
    public function run(Request $request)
    {
        if (!$request->isAjax()) {
            (new Response())->notFound();
        }

        $this->form->load(array_merge($request->body(), [
            'userId' => $this->getUser()->id,
            'photo' => $request->files('photo'),
        ]));
        $contactService = new ContactService(new Contact(), $this->form);

        if ($this->validatorRunner->hasErrors()) {
            return $this->renderPartial('_contact_form', [
                'contactForm' => $this->form,
                'errors' => $this->validatorRunner->getErrors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!$id = $contactService->addContact()) {
            return $this->renderPartial('_contact_form', [
                'contactForm' => $this->form,
                'errors' => $contactService->errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->renderPartial('_contact_info', [
            'contactForm' => $this->form,
            'fields' => $contactService->getContactInfo($id),
        ]);
    }

    /** @inheritDoc */
    public function getValidators(Request $request)
    {
        $requiredFields = [];
        foreach ($this->form->getRequiredFields() as $field) {
            $requiredFields[$field] = $request->body($field);
        }

        return [
            new ImageValidator(['photo' => $request->files('photo')]),
            new RequiredValidator($requiredFields, $this->form),
            new StringValidator([
                'name' => $request->body('name'),
                'secondName' => $request->body('secondName'),
                'email' => $request->body('email'),
                'phone' => $request->body('phone'),
            ]),
            new EmailValidator([
                'email' => $request->body('email'),
            ]),
            new PhoneValidator([
                'phone' => $request->body('phone'),
            ]),
        ];
    }
}
