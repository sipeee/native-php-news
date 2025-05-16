<?php

namespace App\Controller\News;

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
        $loggedInUser = LoginSession::getInstance()->authorize();

        TwigRenderer::getInstance()->render('news/index.html.twig', [
            'loggedInUser' => $loggedInUser,
            'news' => $repository->queryNewsByKeyword($keyword, null === $loggedInUser),
            'searchKeyword' => $keyword,
        ]);
    }
}