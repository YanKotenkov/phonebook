<?php
namespace lib\validators;

class StringValidator extends BaseValidator
{
    /** @var int */
    public $min;
    /** @var int */
    public $max;
    /** @var int */
    public $exactLength;
    /** @var array */
    protected $defaultRules = [
        'isString',
    ];

    /**
     * @param string $attribute
     * @param string $value
     */
    public function isString($attribute, $value)
    {
        if (!is_string($value)) {
            $this->addError(
                $attribute,
                "{$this->getAttributeLabel($attribute)} не является строкой"
            );
        }
    }

    /**
     * @param string $attribute
     * @param string $value
     */
    public function min($attribute, $value)
    {
        if (mb_strlen($value) < $this->min) {
            $this->addError(
                $attribute,
                "{$this->getAttributeLabel($attribute)} должен длиннее, чем {$this->min}"
            );
        }
    }

    /**
     * @param string $attribute
     * @param string $value
     */
    public function max($attribute, $value)
    {
        if (mb_strlen($value) > $this->max) {
            $this->addError(
                $attribute,
                "{$this->getAttributeLabel($attribute)} должен быть короче, чем {$this->max}"
            );
        }
    }

    /**
     * @param string $attribute
     * @param $value
     */
    public function exactLength($attribute, $value)
    {
        if (mb_strlen($value) !== (int)$this->exactLength) {
            $this->addError(
                $attribute,
                "Длина {$this->getAttributeLabel($attribute)} должена быть {$this->exactLength}"
            );
        }
    }
}
