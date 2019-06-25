<?php
namespace lib\base;

use lib\http\Request;
use lib\http\Response;

class UrlResolver
{
    /** @var array */
    public $routes = [];
    /** @var Request */
    public $request;

    /**
     * UrlResolver constructor.
     * @param array $routes
     * @param Request $request
     */
    public function __construct($routes, Request $request)
    {
        $this->routes = $routes;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        $uri = $this->request->server('REQUEST_URI');

        if (in_array($uri, array_keys($this->routes))) {
            $actionClass = new $this->routes[$uri]['action'];
            return $actionClass;
        } else {
            Response::notFound();
        }

        return null;
    }
}
