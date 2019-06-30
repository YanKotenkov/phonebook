<?php
namespace lib\validators;

class PasswordValidator extends BaseValidator
{
    /** @var array */
    protected $defaultRules = [
        'defaultValidation',
    ];

    /**
     * @param string $attribute
     * @param string $value
     */
    public function defaultValidation($attribute, $value)
    {
        $hasLettersAndDigits = ctype_alnum($value);
        if (!$hasLettersAndDigits) {
            $this->addError(
                $attribute,
                "{$this->getAttributeLabel($attribute)} должен содержать буквы и цифры"
            );
        }

        if ($hasLettersAndDigits) {
            if (ctype_alpha($value)) {
                $this->addError(
                    $attribute,
                    "{$this->getAttributeLabel($attribute)} должен содержать хотя бы одну цифру"
                );
            }
            if (ctype_digit($value)) {
                $this->addError(
                    $attribute,
                    "{$this->getAttributeLabel($attribute)} должен содержать хотя бы одну букву"
                );
            }
        }
    }
}
