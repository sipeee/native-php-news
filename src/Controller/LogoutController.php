<?php

namespace App\Controller;

use App\Model\LoginSession;
use App\Model\RequestStack;
use App\Model\SmartyRenderer;
use App\Utility\ResponseUtility;

class LogoutController
{
    public function __invoke()
    {
        $loginSession = LoginSession::getInstance();
        $loginSession->logout();

        ResponseUtility::redirectToAndExit('/');
    }
}