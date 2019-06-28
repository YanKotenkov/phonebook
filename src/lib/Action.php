<?php
namespace lib;

use Exception;
use lib\http\Request;
use lib\http\Response;
use lib\validators\ValidatorRunner;

/**
 * Базовый класс для action'ов
 */
abstract class Action
{
    /** @var string */
    protected $title;
    /** @var string */
    public $layout = 'layout';
    /** @var ValidatorRunner */
    public $validatorRunner;
    /** @var Request */
    protected $request;

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        $this->request = $request;
        $this->validatorRunner = new ValidatorRunner($this->getValidators($request));
        $this->validatorRunner->validate();

        return $this->run($request);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    abstract public function run(Request $request);

    /**
     * @param string $viewName
     * @param array $params
     * @return Response
     * @throws Exception
     */
    protected function render($viewName, array $params = [], $code = null)
    {
        $view = new View($this, $viewName, $this->title);
        $content = $view->getContent($params);

        return new Response($content, $code);
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    protected function getValidators(Request $request)
    {
        return [];
    }

    /**
     * @param string $url
     * @return Response
     */
    protected function redirect($url)
    {
        return (new Response('', 302, [
            'Location' => $url,
        ]))->send();
    }
}
