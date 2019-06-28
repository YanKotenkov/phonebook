<?php
namespace lib\validators;

class ValidatorRunner
{
    /** @var BaseValidator[] */
    public $validators = [];
    /** @var array */
    private $errors = [];

    /**
     * ValidatorRunner constructor.
     * @param BaseValidator[] $validators
     */
    public function __construct($validators)
    {
        $this->validators = $validators;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate()) {
                foreach ($validator->getErrors() as $attribute => $messages) {
                    foreach ($messages as $message) {
                        $this->addError($attribute, $message);
                    }
                }
            }
        }

        return !$this->hasErrors();
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addError($name, $value)
    {
        $this->errors[$name][] = $value;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return (bool)$this->errors;
    }
}
