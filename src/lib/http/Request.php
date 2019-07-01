<?php
namespace lib\http;

class Request
{
    /** @var array $_GET */
    private $query = [];
    /** @var array $_POST */
    private $body = [];
    /** @var array $_FILES */
    private $files = [];
    /** @var array $_SERVER */
    private $server = [];

    /**
     * Request constructor.
     * @param array $query
     * @param array $body
     * @param array $server
     * @param array $files
     */
    public function __construct($query = [], $body = [], $server = [], $files = [])
    {
        $this->query = $this->filterQueryParams($query);
        $this->body = $body;
        $this->server = $server;
        $this->files = $files;
    }

    /**
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    public function query($name = null, $defaultValue = null)
    {
        return $this->getRequestParams('query', $name, $defaultValue);
    }

    /**
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    public function body($name = null, $defaultValue = null)
    {
        return $this->getRequestParams('body', $name, $defaultValue);
    }

    /**
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    public function getRawBody($name = null, $defaultValue = null)
    {
        $jsonInput = file_get_contents('php://input');
        $data = json_decode($jsonInput, true);

        if (is_null($name)) {
            return $data;
        }

        return isset($data[$name]) ? $data[$name] : $defaultValue;
    }

    /**
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    public function files($name = null, $defaultValue = null)
    {
        return $this->getRequestParams('files', $name, $defaultValue);
    }

    /**
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    public function server($name = null, $defaultValue = null)
    {
        return $this->getRequestParams('server', $name, $defaultValue);
    }

    /**
     * @return string
     */
    public function isPost()
    {
        $method = $this->getRequestParams('server', 'REQUEST_METHOD');

        return $method === 'POST';
    }

    /**
     * @return bool
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function filterQueryParams($params)
    {
        $filteredQueryParams = [];
        foreach ($params as $key => $value) {
            $key = ltrim($key, '?');
            $filteredQueryParams[$key] = $value;
        }

        return $filteredQueryParams;
    }

    /**
     * @param string $requestParam
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    private function getRequestParams($requestParam, $name = null, $defaultValue = null)
    {
        if (is_null($name)) {
            return $this->$requestParam;
        }

        $params = $this->$requestParam;

        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }
}
