<?php

namespace App\Utility;

use Symfony\Component\HttpFoundation\RedirectResponse;

class ResponseUtility
{
    public static function redirectToAndExit(string $url): void
    {
        $response = new RedirectResponse($url);
        $response->send();

        exit;
    }
}