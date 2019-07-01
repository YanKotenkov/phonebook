<?php
namespace services;

use forms\ContactForm;
use lib\helpers\NumberHelper;
use lib\BaseForm;
use models\Contact;

/**
 * Класс для работы с контактами
 */
class ContactService
{
    /** @var string */
    public $sortParam = 'name';
    /** @var string */
    public $sortOrder = 'ASC';
    /** @var array */
    public $errors = [];

    /** @var Contact */
    private $contactModel;
    /** @var ContactForm */
    private $contactForm;

    /**
     * ContactService constructor.
     * @param Contact $contactModel
     * @param ContactForm|BaseForm $contactForm
     */
    public function __construct(Contact $contactModel, ContactForm $contactForm)
    {
        $this->contactModel = $contactModel;
        $this->contactForm = $contactForm;
    }

    /**
     * @return ContactForm[]
     */
    public function getContactList()
    {
        $contacts = $this->contactModel->getAll($this->contactForm->userId, $this->getSort());

        $data = [];
        foreach ($contacts as $contact) {
            $contactForm = new ContactForm();
            foreach ($this->contactForm->mapAttributes() as $modelAttribute => $formAttribute) {
                $contactForm->$formAttribute = $contact->$modelAttribute;
            }
            $data[$contact->id] = $contactForm;
        }

        return $data;
    }

    /**
     * @return array
     */
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

    /**
     * @param int $id
     * @return array
     */
    public function getContactInfo($id)
    {
        $fields = [];

        $contact = $id ? $this->contactModel->findByPk($id) : $this->contactModel;

        foreach ($this->contactForm->mapAttributes() as $dbField => $formField) {
            $fields[$formField] = $contact->{$dbField};
        }
        $fields['phoneToWords'] = NumberHelper::sumToWords((int)$contact->phone);

        return $fields;
    }

    /**
     * @return bool
     */
    public function addContact()
    {
        foreach (array_flip($this->contactForm->mapAttributes()) as $formField => $dbField) {
            $this->contactModel->$dbField = $this->contactForm->$formField;
        }

        $this->contactModel->photo = addslashes(file_get_contents($this->contactForm->photo['tmp_name']));

        if (!$this->contactModel->insert(['user_id', 'name', 'second_name', 'phone', 'email', 'photo'])) {
            $this->errors = $this->contactModel->getErrors();

            return false;
        }

        return $this->contactModel->id;
    }
}
