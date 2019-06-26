<?php
namespace lib\base;

use Exception;
use RuntimeException;

/**
 * Класс для работы с представлением
 */
class View
{
    /** @var string */
    public $title;
    /** @var string */
    private $viewName;
    /** @var Action */
    private $controller;

    /**
     * View constructor.
     * @param Action $controller
     * @param string $viewName
     * @param string $title
     */
    public function __construct(Action $controller, $viewName, $title = '')
    {
        $this->controller = $controller;
        $this->viewName = $viewName;
        $this->title = $title;
    }

    /**
     * @param array $params
     * @return false|string
     * @throws Exception
     */
    public function getContent(array $params = [])
    {
        try {
            ob_start();
            extract($params);
            include $this->getViewFilePath($this->controller->layout);
            return ob_get_clean();
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }

    /**
     * @return string
     */
    public function getBodyContent()
    {
        return include $this->getViewFilePath($this->viewName);
    }

    /**
     * @param string $name
     */
    public function registerCssFile($name)
    {
        echo "<link rel='stylesheet' type='text/css' href='assets/css/$name.css'>";
    }

    /**
     * @param string $viewName
     * @return string
     */
    protected function getViewFilePath($viewName)
    {
        $viewFilePath = VIEW_PATH . $viewName . '.php';
        if (!file_exists($viewFilePath)) {
            throw new RuntimeException("Файл $viewFilePath не найден");
        }

        return $viewFilePath;
    }
}
