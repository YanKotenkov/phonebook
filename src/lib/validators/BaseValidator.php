<?php
namespace validators;

abstract class BaseValidator
{
    /** @var array [$name => $value] */
    public $attributes = [];

    protected $errors = [];

    /**
     * BaseValidator constructor.
     * @param array $rules
     * @throws \Exception
     */
    public function __construct(array $rules)
    {
        if (!isset($rules['attributes'])) {
            throw new \Exception('Нужно задать поля для валидации');
        }
        $this->attributes = $rules['attributes'];
        unset($rules['attributes']);
        foreach ($rules as $name => $value) {
            if (property_exists(static::class, $name)) {
                $this->$name = $value;
            }
        }
    }

    /**
     * Запуск валидатора
     * @return bool
     */
    abstract function run();

    /**
     * @param string $attr
     * @param string $message
     */
    public function addError($attr, $message)
    {
        $this->errors[$attr][] = $message;
    }

    /** @return bool */
    public function hasErrors()
    {
        return (bool)$this->errors;
    }
}
