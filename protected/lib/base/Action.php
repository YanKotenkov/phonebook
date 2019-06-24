<?php
namespace lib\base;

use lib\http\Request;

abstract class Action
{
    /**
     * @param Request $request
     * @return mixed
     */
    abstract public function __invoke(Request $request);

    /**
     * @param string $viewFile
     * @param array $params
     * @return false|string
     */
    protected function render($viewFile, $params = [])
    {
        ob_start();
        extract($params);
        include $viewFile;
        return ob_get_clean();
    }
}
