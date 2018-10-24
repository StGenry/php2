<?php


namespace app\services\renderers;


class TemplateRenderer implements IRenderer
{
    public static function getTemplateFolder() {
        return TEMPLATES_DIR;
    }
    
    public static function getTemplateExtention() {
        return ".php";
    }

    public function render($template, $params = []) {
        ob_start();
        extract($params);
        include self::getTemplateFolder() . $template . self::getTemplateExtention();
        return ob_get_clean();
    }
}