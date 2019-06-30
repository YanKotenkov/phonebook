<?php
namespace services;

use forms\ContactForm;
use models\Contact;

class ContactService
{
    /** @var string */
    public $sortParam = 'name';
    /** @var string */
    public $sortOrder = 'ASC';

    /** @var Contact */
    private $contactModel;
    /** @var ContactForm */
    private $contactForm;

    /**
     * ContactService constructor.
     * @param Contact $contactModel
     * @param ContactForm $contactForm
     */
    public function __construct(Contact $contactModel, ContactForm $contactForm)
    {
        $this->contactModel = $contactModel;
        $this->contactForm = $contactForm;
    }

    /**
     * @param mixed $sort
     * @return ContactForm[]
     */
    public function getContactList()
    {
        $sort = $this->getSort();

        $contacts = $this->contactModel->getAll($sort);

        $data = [];
        foreach ($contacts as $contact) {
            $contactForm = new contactForm();
            foreach ($this->contactForm->mapAttributes() as $modelAttribute => $formAttribute) {
                $contactForm->$formAttribute = $contact->$modelAttribute;
            }
            $data[$contact->id] = $contactForm;
        }

        return $data;
    }

    public function getSort()
    {
        if ($this->sortParam && $this->sortOrder) {
            $mapAttributes = array_flip($this->contactForm->mapAttributes());
            if (isset($mapAttributes[$this->sortParam])) {
                return [$mapAttributes[$this->sortParam] => $this->sortOrder];
            }
        }

        return [];
    }
}
