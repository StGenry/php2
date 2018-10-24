<?php

namespace app\controllers;
use app\services\renderers as SR;
use app\services\renderers\TemplateRenderer;

abstract class Controller
{
    public $action;
    public $defaultAction = 'index';
    public $layout = "main";
//    public $useLayout = true;
    public $useLayout = false;

    public function __construct(SR\IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action = null)
    {
        $this->action = $action?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)){
            $this->$method();
        } else {
            echo "404";
        }
    }

    public function render($template, $params = [])
    {
        if($this->useLayout){
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }
        return $this->renderTemplate($template, $params);
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $params);

        // ob_start();
        // extract($params);
        // include TEMPLATES_DIR . $template . ".php";
        // return ob_get_clean();
    }
    
}