<?php

namespace App\Controller;

use App\Model\TwigRenderer;

class LoginController
{
    public function __invoke()
    {
        TwigRenderer::getInstance()->render('login.html.twig');
    }
}