<?php
namespace lib\validators;

class RequiredValidator extends BaseValidator
{
    /** @var array */
    protected $defaultRules = [
        'required'
    ];

    /**
     * @param string $attribute
     * @param mixed $value
     */
    public function required($attribute, $value)
    {
        if ($value === null || $value === [] || $value === '') {
            $this->addError(
                $attribute,
                "Нужно заполнить {$this->getAttributeLabel($attribute)}"
            );
        }
    }
}
