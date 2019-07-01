<?php
namespace lib\validators;

/**
 * Валидатор для изображений
 */
class ImageValidator extends BaseValidator
{
    /** @var array */
    public static $errorCodes = [
        UPLOAD_ERR_INI_SIZE => 'Превышен максимальный размер файла',
        UPLOAD_ERR_FORM_SIZE => 'Превышен максимальный размер файла',
        UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично',
        UPLOAD_ERR_NO_FILE => 'Файл не был загружен',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
        UPLOAD_ERR_EXTENSION => 'Произошла непредвиденная ошибка при загрузке файла',
    ];
    /** @var array Возможные типы изображений */
    private static $possibleFileTypes = [
        'image/jpeg',
        'image/jpg',
        'image/png'
    ];
    /** @var int */
    public $maxFileSize;
    /** @var array */
    protected $defaultRules = [
        'defaultValidation',
        'checkType',
    ];

    /**
     * @param string $name
     * @param array $value
     */
    public function defaultValidation($name, $value)
    {
        if (isset($value['error']) && ($error = self::getFileError($value['error']))) {
            $this->addError($name, $error);
        }
    }

    /**
     * @param string $name
     * @param array $value
     */
    public function checkType($name, $value)
    {
        $type = isset($value['type']) ? $value['type'] : null;
        if (empty($type) || !in_array($type, self::$possibleFileTypes)) {
            $this->addError(
                $name,
                "Формат {$this->getAttributeLabel($name)} должен быть jpg либо png"
            );
        }
    }

    /**
     * @param int $code
     * @return string|null
     */
    public static function getFileError($code)
    {
        return isset(self::$errorCodes[$code]) ? self::$errorCodes[$code] : null;
    }
}
