<?php


namespace app\services\renderers;

use app\interfaces\RendererInterface;

class TwigRenderer implements RendererInterface
{
    public function render(string $templateName, array $params = []): string
    {
        $loader = new \Twig\Loader\FilesystemLoader(TWIG_VIEWS_DIR);
        $twig = new \Twig\Environment($loader);
        $templateName .= ".twig";
        return $twig->render($templateName, $params);
    }
}
