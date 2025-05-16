<?php

namespace App\Controller\News;

use App\Model\LoginSession;
use App\Model\Repository;
use App\Model\RequestStack;
use App\Model\TwigRenderer;
use App\Utility\ResponseUtility;

class ShowController
{
    public function __invoke()
    {
        $repository = new Repository();

        $request = RequestStack::getInstance()->getRequest();
        $id = $request->query->get('id');

        if (empty($id) || !is_string($id) || !ctype_digit($id)) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        $loggedInUser = LoginSession::getInstance()->authorize();
        $article = $repository->queryArticleById($id, null === $loggedInUser);

        if (null === $article) {
            ResponseUtility::redirectToAndExit('/news/index.php');
        }

        TwigRenderer::getInstance()->render('news/show.html.twig', [
            'loggedInUser' => $loggedInUser,
            'article' => $article,
        ]);
    }
}