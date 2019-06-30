<?php
namespace lib;

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
        $uri = $this->getUri();

        if (in_array($uri, array_keys($this->routes))) {
            $route = $this->routes[$uri];
            $actionClass = new $route['action'];
            return $actionClass;
        } else {
            (new Response())->notFound();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        $requestUri = $this->request->server('REQUEST_URI');
        $parsedUrl = parse_url($requestUri);

        return isset($parsedUrl['path']) ? $parsedUrl['path'] : $requestUri;
    }
}
