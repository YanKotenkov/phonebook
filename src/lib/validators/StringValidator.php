<?php
namespace validators;

class StringValidator extends BaseValidator
{
    /** @var int */
    public $min;
    /** @var int */
    public $max;
    /** @var int */
    public $exactLength;

    /** @inheritdoc */
    public function run()
    {
        foreach ($this->attributes as $name => $value) {
            if (!$this->isString($value) || !$this->validateMin($value) || !$this->validateMax($value) || !$this->validateExactLength()) {
                $this->addError($name, $value);
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isString($value)
    {
        return is_string($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validateMin($value)
    {
        return mb_strlen($value) >= $this->min;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validateMax($value)
    {
        return mb_strlen($value) <= $this->min;
    }

    public function validateExactLength($value)
    {
        return mb_strlen($value) === (int)$this->min;
    }
}
