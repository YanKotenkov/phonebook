<?php
namespace actions;

use forms\ContactForm;
use lib\Action;
use lib\http\Request;
use models\Contact;
use services\ContactService;

class GetContactFormAction extends Action
{
    /** @var string */
    protected $formClass = ContactForm::class;

    /** @inheritDoc */
    public function run(Request $request)
    {
        $this->form->load([
            'userId' => $this->getUser()->id,
        ]);

        if ($id = $request->query('id')) {
            $contactService = new ContactService(new Contact(), $this->form);
            $contactForm = $contactService->fillContactForm($id);
        } else {
            $contactForm = $this->form;
        }

        return $this->renderPartial('_contact_form', compact('contactForm'));
    }
}
