<?php
namespace lib;

abstract class BaseForm
{
    /** @var array */
    public static $requiredFields = [];

    /**
     * @return array
     */
    abstract public function attributeLabels();

    /**
     * @param string $name
     * @return string
     */
    public function getLabel($name)
    {
        return isset($this->attributeLabels()[$name]) ? $this->attributeLabels()[$name] : '';
    }

    /**
     * @param array $data
     */
    public function load(array $data)
    {
        foreach ($data as $name => $value) {
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
    }

    /**
     * @param string $field
     * @return bool
     */
    public function isRequired($field)
    {
        return in_array($field, $this->getRequiredFields());
    }

    /**
     * @return array
     */
    public function getRequiredFields()
    {
        return [];
    }
}
