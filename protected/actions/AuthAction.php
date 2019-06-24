<?php
namespace actions;

use lib\base\Action;

class AuthAction extends Action
{
    public function __invoke(\lib\http\Request $request)
    {
        return $this->render(ROOT_DIR . '/views/auth.php', ['testVar' => 'test']);
    }
}
