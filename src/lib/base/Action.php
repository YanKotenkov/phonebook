<?php
namespace lib\base;

use Exception;
use lib\http\Request;
use lib\http\Response;
use RuntimeException;

abstract class Action
{
    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    abstract public function __invoke(Request $request);

    /**
     * @param string $viewName
     * @param array $params
     * @return Response
     * @throws Exception
     */
    protected function render($viewName, $params = [])
    {
        $viewFilePath = $this->getViewFilePath($viewName);
        if (!file_exists($viewFilePath)) {
            throw new RuntimeException("Файл $viewFilePath не найден");
        }

        try {
            ob_start();
            extract($params);
            include $viewFilePath;
            return new Response(ob_get_clean());
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }

    /**
     * @param string $viewName
     * @return string
     */
    protected function getViewFilePath($viewName)
    {
        return ROOT_DIR . '/views/' . $viewName . '.php';
    }
}
