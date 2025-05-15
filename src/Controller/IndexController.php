<?php

namespace App\Controller;

use App\Model\LoginSession;
use App\Model\Repository;
use App\Model\TwigRenderer;

class IndexController
{
    public function __invoke()
    {
        $repository = new Repository();

        TwigRenderer::getInstance()->render('index.html.twig', [
            'loggedInUser' => LoginSession::getInstance()->authorize(),
            'news' => $repository->queryPublishedNews()
        ]);
    }
}