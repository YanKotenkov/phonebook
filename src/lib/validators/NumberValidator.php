<?php
namespace lib\validators;

class NumberValidator extends BaseValidator
{
    /** @var int */
    public $min;
    /** @var int */
    public $max;
    /** @var array  */
    protected $defaultRules = [
        'isNumber',
    ];

    /**
     * @param string $attribute
     * @param int $value
     */
    public function isNumber($attribute, $value)
    {
        if (!(is_int(intval($value)) && (mb_strlen($value) === mb_strlen(intval($value))))) {
            $this->addError(
                $attribute,
                "{$this->getAttributeLabel($attribute)} должен быть числом"
            );
        }
    }

    /**
     * @param string $attribute
     * @param int $value
     * @return void
     */
    public function min($attribute, $value)
    {
        if ($value < $this->min) {
            $this->addError(
                $attribute,
                "Значение {$this->getAttributeLabel($attribute)} должно быть больше чем {$this->min}"
            );
        }
    }

    /**
     * @param string $attribute
     * @param int $value
     * @return void
     */
    public function max($attribute, $value)
    {
        if ($value > $this->max) {
            $this->addError(
                $attribute,
                "Значение {$this->getAttributeLabel($attribute)} должно быть не больше чем {$this->max}"
            );
        }
    }
}
