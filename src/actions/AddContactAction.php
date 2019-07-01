<?php
namespace actions;

use forms\ContactForm;
use lib\Action;
use lib\http\Request;
use lib\http\Response;
use lib\validators\EmailValidator;
use lib\validators\RequiredValidator;
use lib\validators\StringValidator;
use models\Contact;
use services\ContactService;

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

        $this->form->load(array_merge($request->getRawBody(), ['userId' => $this->getUser()->id]));
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
            $requiredFields[$field] = $request->getRawBody($field);
        }

        return [
            new RequiredValidator($requiredFields, $this->form),
            new StringValidator([
                'name' => $request->getRawBody('name'),
                'secondName' => $request->getRawBody('secondName'),
                'email' => $request->getRawBody('email'),
                'phone' => $request->getRawBody('phone'),
            ]),
            new EmailValidator([
                'email' => $request->getRawBody('email'),
            ]),
        ];
    }
}
