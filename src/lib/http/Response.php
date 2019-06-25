<?php
namespace lib\http;

class Response
{
    /** @var string */
    public $content;

    /**
     * Response constructor.
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Отправляет заголовки и контент
     * @return $this
     */
    public function send()
    {
        $this->sendHeaders();
        echo $this->content;

        return $this;
    }

    /**
     * @return void
     */
    public static function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        exit();
    }

    /**
     * @return $this
     */
    private function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }

        return $this;
    }
}
