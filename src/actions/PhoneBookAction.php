<?php
namespace actions;

use lib\Action;
use lib\http\Request;

/**
 * Экшн телефонная книга
 */
class PhoneBookAction extends Action
{
    /** @var string */
    protected $title = 'Телефонная книга';

    /** @inheritdoc */
    public function run(Request $request)
    {
        return $this->render('phone_book', ['user' => $this->session->getUser()]);
    }
}
