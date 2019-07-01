<?php
namespace forms;

use lib\BaseForm;
use models\Contact;

class ContactForm extends BaseForm
{
    /** @var string */
    public $name;
    /** @var string */
    public $secondName;
    /** @var mixed */
    public $photo;
    /** @var string */
    public $email;
    /** @var string */
    public $phone;
    /** @var int */
    public $userId;
    /** @var string */
    public $insDate;

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'secondName' => 'Фамилия',
            'photo' => 'Фотография',
            'email' => 'Email',
            'phone' => 'Телефон',
            'insDate' => 'Дата создания',
            'phoneToWords' => 'Телефон в буквенном представлении',
            'userId' => 'Id пользователя',
        ];
    }

    /**
     * @return array
     */
    public function mapAttributes()
    {
        return [
            'name' => 'name',
            'second_name' => 'secondName',
            'photo' => 'photo',
            'email' => 'email',
            'phone' => 'phone',
            'ins_date' => 'insDate',
            'user_id' => 'userId',
        ];
    }

    /** @inheritDoc */
    public function getRequiredFields()
    {
        return [
            'name',
            'phone',
            'email',
        ];
    }
}
