<?php
namespace lib\validators;

use Exception;
use lib\ActiveRecord;
use lib\BaseForm;

abstract class BaseValidator
{
    /** @var array [$name => $value] */
    public $attributes = [];
    /** @var ActiveRecord */
    public $model;
    /** @var array */
    protected $errors = [];
    /** @var array Правила, которые будут запускаться всегда по умолчанию */
    protected $defaultRules = [];
    /** @var array */
    private $rules = [];

    /**
     * BaseValidator constructor.
     * @param array $attributes
     * @param BaseForm $model
     * @param array $rules
     * @throws Exception
     */
    public function __construct(array $attributes, $model = null, $rules = [])
    {
        $this->attributes = $attributes;
        $this->model = $model;
        foreach ($rules as $name => $value) {
            if (property_exists(static::class, $name)) {
                $this->$name = $value;
                $this->rules[] = $name;
            } else {
                throw new Exception("Неизвестное правило $name");
            }
        }
    }

    /**
     * Запуск валидатора
     * @return bool
     */
    public function validate()
    {
        foreach ($this->attributes as $attribute => $value) {
            foreach (array_merge($this->rules, $this->defaultRules) as $rule) {
                $this->{$rule}($attribute, $value);
            }
        }

        return !$this->hasErrors();
    }

    /**
     * @param string $attribute
     * @return string
     */
    public function getAttributeLabel($attribute)
    {
        if (isset($this->model) && method_exists($this->model, 'getLabel')) {
            return $this->model->getLabel($attribute);
        }

        return $attribute;
    }

    /**
     * @param string $attr
     * @param string $message
     */
    public function addError($attr, $message)
    {
        $this->errors[$attr][] = $message;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /** @return bool */
    public function hasErrors()
    {
        return (bool)$this->errors;
    }
}
