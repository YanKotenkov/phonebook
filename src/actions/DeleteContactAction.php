<?php
namespace actions;

use forms\ContactForm;
use lib\Action;
use lib\http\Request;
use lib\http\Response;
use models\Contact;
use services\ContactService;

class DeleteContactAction extends Action
{
    /** @var string */
    protected $formClass = ContactForm::class;

    /** @inheritdoc */
    public function run(Request $request)
    {
        if (!$request->isAjax()) {
            (new Response())->notFound();
        }

        $id = $request->query('id');
        $contactService = new ContactService(new Contact(), $this->form);

        return $contactService->deleteContact($id);
    }
}
