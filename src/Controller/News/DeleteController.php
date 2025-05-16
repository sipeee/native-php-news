<?php

namespace App\Controller\News;

use App\Model\Crud\Configuration\NewsCrudConfiguration;
use App\Model\Crud\DeleteManager;
use App\Model\LoginSession;
use App\Utility\ResponseUtility;

class DeleteController
{
    public function __invoke()
    {
        $loginSession = LoginSession::getInstance();
        $loggedInUser = $loginSession->authorize();

        if (null === $loggedInUser) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        $configuration = new NewsCrudConfiguration();
        $manager = new DeleteManager($configuration);
        $manager->handle();

        ResponseUtility::redirectToAndExit('/news/index.php');
    }
}