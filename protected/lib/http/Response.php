<?php
namespace lib\http;


class Response
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        echo $this->content;

        return $this;
    }
}
