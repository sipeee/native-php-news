<?php

namespace App\Controller\News;

use App\Model\Crud\Configuration\NewsCrudConfiguration;
use App\Model\EditManager;
use App\Model\LoginSession;
use App\Model\NewManager;
use App\Model\TwigRenderer;
use App\Utility\ResponseUtility;

class EditController
{
    public function __invoke()
    {
        $loginSession = LoginSession::getInstance();
        $loggedInUser = $loginSession->authorize();

        if (null === $loggedInUser) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        $configuration = new NewsCrudConfiguration();
        $manager = new EditManager($configuration);
        $parameters = $manager->handle();
        if (null === $parameters) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        TwigRenderer::getInstance()->render('news/edit.html.twig', array_merge($parameters, [
            'loggedInUser' => $loggedInUser,
            'configuration' => $configuration,
        ]));
    }
}