<?php
namespace actions;

use forms\ContactForm;
use lib\Action;
use lib\http\Request;
use models\Contact;
use services\ContactService;

/**
 * Экшн телефонная книга
 */
class PhoneBookAction extends Action
{
    /** @var string */
    protected $title = 'Телефонная книга';
    /** @var string */
    protected $formClass = ContactForm::class;

    /** @inheritdoc */
    public function run(Request $request)
    {
        $sortParam = $request->query('sortParam');
        $sortOrder = $request->query('sortOrder');
        $contactService = new ContactService(new Contact(), new ContactForm());
        $contactService->sortParam = $sortParam;
        $contactService->sortOrder = $sortOrder;

        $viewParams = [
            'contactForm' => $this->form,
            'contactList' => $contactService->getContactList(),
            'sortParam' => $sortParam,
            'sortOrder' => $sortOrder,
        ];

        if ($request->isAjax()) {
            return $this->renderPartial('_contact_table', $viewParams);
        }

        return $this->render('phone_book', array_merge([
            'user' => $this->session->getUser(),
        ], $viewParams));
    }
}
