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
    /** @var string */
    protected $formClass;
    /** @var BaseForm */
    protected $form;
    /** @var Session */
    protected $session;
    /** @var bool */
    protected $needAuthentication = true;

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        $this->session = new Session();
        $this->session->start();

        if (!$this->isAuthenticated() && $this->needAuthentication) {
            $this->redirect('/auth');
        }

        $this->request = $request;
        $this->form = $this->formClass ? new $this->formClass : null;
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
     * @return \models\User
     */
    public function getUser()
    {
        return $this->session->getUser();
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->session->has(Session::SESSION_USER_ID);
    }

    /**
     * @param string $viewName
     * @param array $params
     * @param int $code
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
     * @param string $viewName
     * @param array $params
     * @param int $code
     * @return Response
     */
    protected function renderPartial($viewName, array $params = [], $code = null)
    {
        $view = new View($this, $viewName);

        $content = $view->render($viewName, $params);

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
