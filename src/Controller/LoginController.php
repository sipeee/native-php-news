<?php

namespace App\Controller;

use App\Model\LoginSession;
use App\Model\RequestStack;
use App\Model\TwigRenderer;
use App\Utility\ResponseUtility;

class LoginController
{
    public function __invoke()
    {
        $loginSession = LoginSession::getInstance();
        $loggedInUser = $loginSession->authorize();

        if (null !== $loggedInUser) {
            ResponseUtility::redirectToAndExit('/');
        }

        $request = RequestStack::getInstance()->getRequest();

        if ($request->isMethod('POST') && $request->request->has('login')) {
            $loginData = $request->request->all('login');
            $wrongLogin = !$loginSession->authenticate($loginData['email'], $loginData['password']);
            if (!$wrongLogin) {
                ResponseUtility::redirectToAndExit('/');
            }
        }

        TwigRenderer::getInstance()->render('login.html.twig', [
            'loggedInUser' => $loginSession->authorize(),
        ]);
    }
}