<?php
namespace validators;

class NumberValidator extends BaseValidator
{
    /** @var int */
    public $min;
    /** @var int */
    public $max;

    /** @inheritdoc */
    public function run()
    {
        foreach ($this->attributes as $name => $value) {
            if (!$this->isNumber($value) || !$this->validateMin($value) || !$this->validateMax($value)) {
                $this->addError($name, $value);
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $value
     * @return bool
     */
    public function isNumber($value)
    {
        return is_int(intval($value)) && (mb_strlen($value) === mb_strlen(intval($value)));
    }

    /**
     * @param int $value
     * @return bool
     */
    public function validateMin($value)
    {
        return $value >= $this->min;
    }

    /**
     * @param int $value
     * @return bool
     */
    public function validateMax($value)
    {
        return $value <= $this->max;
    }
}
