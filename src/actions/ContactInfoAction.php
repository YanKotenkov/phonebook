<?php
namespace actions;

use forms\ContactForm;
use lib\Action;
use lib\http\Request;
use models\Contact;
use services\ContactService;

class ContactInfoAction extends Action
{
    /** @var string  */
    protected $formClass = ContactForm::class;

    /** @inheritdoc */
    public function run(Request $request)
    {
        $id = $request->query('id');

        $contactService = new ContactService(new Contact(), $this->form);
        $fields = $contactService->getContactInfo($id);

        $viewParams = [
            'fields' => $fields,
            'contactForm' => $this->form,
            'id' => $id,
        ];

        if ($request->isAjax()) {
            return $this->renderPartial('_contact_info', $viewParams);
        }

        return $this->render('_contact_info', $viewParams);
    }
}
