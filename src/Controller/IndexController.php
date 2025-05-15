<?php

namespace App\Controller;

use App\Model\LoginSession;
use App\Model\Repository;
use App\Model\RequestStack;
use App\Model\TwigRenderer;

class IndexController
{
    public function __invoke()
    {
        $request = RequestStack::getInstance()->getRequest();
        $keyword = $request->query->get('search');
        if (!is_string($keyword)) {
            $keyword = null;
        }

        $repository = new Repository();

        TwigRenderer::getInstance()->render('index.html.twig', [
            'loggedInUser' => LoginSession::getInstance()->authorize(),
            'news' => $repository->queryPublishedNewsByKeyword($keyword),
            'searchKeyword' => $keyword,
        ]);
    }
}