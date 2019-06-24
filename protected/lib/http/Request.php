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
        $this->query = $query;
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
