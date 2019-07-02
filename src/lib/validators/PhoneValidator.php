<?php


namespace lib\validators;


class PhoneValidator extends BaseValidator
{
    /** @var string */
    const PHONE_REGEX = '/^(\+?7|8)?[- (]?(\d{3})?[- )]?[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/';

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
        if (!preg_match(self::PHONE_REGEX, $value)) {
            $this->addError(
                $name,
                "{$this->getAttributeLabel($name)} неверный формат телефона"
            );
        }
    }
}
