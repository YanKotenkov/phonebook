<?php


namespace lib\validators;


class PhoneValidator extends BaseValidator
{
    /** @var array */
    protected $defaultRules = [
        'defaultValidation',
    ];

    /**
     * @param string $name
     * @param string $value
     */
    public function defaultValidation($name, $value)
    {
        if (!preg_match('/^(\+?7|8)?[- (]?(\d{3})?[- )]?[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/', $value)) {
            $this->addError(
                $name,
                "{$this->getAttributeLabel($name)} неверный формат телефона"
            );
        }
    }
}
