<?php


namespace app\services\renderers;


class TwigRenderer implements IRenderer
{
    public static function getTemplateFolder() {
        return TWIG_TEMPLATES_DIR;
    }
    
    public static function getTemplateExtention() {
        return ".twig";
    }

    public function render($template, $params = []) {
        $loader = new \Twig_Loader_Filesystem(self::getTemplateFolder());
        $twig = new \Twig_Environment($loader);

        return $twig->render($template . self::getTemplateExtention(), $params);
    }
}