<?php

namespace App\Controller\News;

use App\Model\Crud\Configuration\NewsCrudConfiguration;
use App\Model\Crud\NewManager;
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

        $configuration = new NewsCrudConfiguration();
        $manager = new NewManager($configuration);
        $parameters = $manager->handle();
        if (null === $parameters) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        TwigRenderer::getInstance()->render('news/new.html.twig', array_merge($parameters, [
            'loggedInUser' => $loggedInUser,
            'configuration' => $configuration,
        ]));
    }
}