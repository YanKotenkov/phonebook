<?php
namespace lib\http;

class Response
{
    const HTTP_CODE_OK = 200;
    const HTTP_CODE_NOT_FOUND = 404;

    public static $statusTexts = [
        self::HTTP_CODE_OK => 'OK',
        self::HTTP_CODE_NOT_FOUND => 'Not Found',
    ];

    /** @var string */
    public $content;
    /** @var int */
    public $code;
    /** @var array */
    public $headers;

    /**
     * Response constructor.
     * @param string $content
     * @param int $code
     * @param array $headers
     */
    public function __construct($content = '', $code = self::HTTP_CODE_OK, $headers = [])
    {
        $this->content = $content;
        $this->code = $code;
        $this->headers = $headers;
    }

    /**
     * Отправляет заголовки и контент
     * @return $this
     */
    public function send()
    {
        $this->setStatusCode($this->code);
        $this->sendHeaders();
        echo $this->content;

        return $this;
    }

    /**
     * Устанавливает код http ответа
     * @param int $code
     */
    public function setStatusCode($code)
    {
        if (isset(self::$statusTexts[$code])) {
            header("HTTP/1.0 {$code}" . ' ' . self::$statusTexts[$code]);
        }
    }

    /**
     * @return void
     */
    public function notFound()
    {
        $this->setStatusCode(self::HTTP_CODE_NOT_FOUND);
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

        header('Content-Type: text/html; charset=utf-8');
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        return $this;
    }
}
