<?php
namespace lib;

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
    /** @var string */
    private $bodyContent;

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
            $this->bodyContent = $this->render($this->viewName, $params);

            return $this->render($this->controller->layout);
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }

    /**
     * @param string $viewName
     * @param array $params
     * @return false|string
     */
    public function render($viewName, $params = [])
    {
        ob_start();
        extract($params, EXTR_OVERWRITE);
        include_once $this->getViewFilePath($viewName);

        return ob_get_clean();
    }

    /**
     * @return string
     */
    public function getBodyContent()
    {
        return $this->bodyContent;
    }

    /**
     * @param string $name
     */
    public function registerCssFile($name)
    {
        echo "<link rel='stylesheet' type='text/css' href='css/$name.css'>";
    }

    /**
     * @param string $name
     */
    public function registerJsFile($name)
    {
        echo "<script src='js/$name.js' type='application/javascript'></script>";
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->controller->isAuthenticated();
    }

    /**
     * @return \models\User
     */
    public function getUser()
    {
        return $this->controller->getUser();
    }

    /**
     * @param string $content
     * @param bool $doubleEncode
     * @return string
     */
    public static function encode($content, $doubleEncode = true)
    {
        return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE,  'UTF-8', $doubleEncode);
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
