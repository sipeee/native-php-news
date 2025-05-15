<?php

namespace App\Controller\News;

use App\Model\LoginSession;
use App\Model\TwigRenderer;
use App\Utility\ResponseUtility;

class CreateController
{
    public function __invoke()
    {
        $loginSession = LoginSession::getInstance();
        $loggedInUser = $loginSession->authorize();

        if (null === $loggedInUser) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        TwigRenderer::getInstance()->render('new.html.twig', [
            'loggedInUser' => $loggedInUser,
            'article' => [],
        ]);
    }
}