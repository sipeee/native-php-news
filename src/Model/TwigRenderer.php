<?php

namespace App\Model;

use App\EnvConfig;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

class TwigRenderer
{
    private ?Twig $twig = null;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        return new self();
    }

    public function render(string $template, array $params = []): void
    {
        $twig = $this->getTwigEnvironment();

        $response = new Response($twig->render($template, $params));
        $response->send();
    }

    private function getTwigEnvironment(): Twig
    {
        if (null === $this->twig) {
            $this->twig = $this->createTwigEnvironment();
        }

        return $this->twig;
    }

    private function createTwigEnvironment(): Twig
    {
        $envConfig = EnvConfig::getInstance();
        $isProd = $envConfig->isProdEnvironment();

        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $twig = new Twig($loader, [
            'cache' => __DIR__ . '/../../var/twig_cache',
            'debug' => !$isProd,
            'auto_reload' => !$isProd,
            'strict_variables' => !$isProd,
            'autoescape' => 'html',
        ]);

        return $twig;
    }
}