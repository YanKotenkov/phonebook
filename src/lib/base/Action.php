<?php
namespace lib\base;

use Exception;
use lib\http\Request;
use lib\http\Response;

/**
 * Базовый класс для action'ов
 */
abstract class Action
{
    /** @var string */
    protected $title;
    /** @var string */
    public $layout = 'layout';

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
    protected function render($viewName, array $params = [])
    {
        $params = array_merge($params);
        $view = new View($this, $viewName, $this->title);
        $content = $view->getContent($params);

        return new Response($content);
    }
}
