<?php


namespace app\services\renderers;

use app\base\App;

class TemplateRenderer implements IRenderer
{
    public static function getTemplateFolder() {
        return App::call()->config['templatesDir'];
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