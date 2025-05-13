<?php

namespace App\Controller;

use App\Model\Repository;
use App\Model\TwigRenderer;

class IndexController
{
    public function __invoke()
    {
        $repository = new Repository();

        TwigRenderer::getInstance()->render('index.html.twig', [
            'news' => $repository->queryPublishedNews(),
        ]);
    }
}