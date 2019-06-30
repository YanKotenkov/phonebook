<?php
namespace lib\validators;

class EmailValidator extends BaseValidator
{
    /** @var array  */
    protected $defaultRules = [
        'isEmail',
    ];

    /**
     * @param string $attribute
     * @param string $value
     */
    public function isEmail($attribute, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($attribute, "{$attribute} не является email адресом");
        }
    }
}
