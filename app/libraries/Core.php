<?php

namespace app\libraries;

use app\config\Config;

class Core
{
    protected $currentController = 'PagesController';
    protected $currentAction = 'index';
    protected $params = [];
    public static Request $request;

    public function __construct(Config $config)
    {
        foreach ($config as $constant => $value) {
            $$constant = $value;
        }
        $url = $this->getUrl();
        self::$request = new Request();

        $controllerName = "app\controllers\\" . ucfirst($url[0]) . 'Controller';
        $actionName = $url[1] ?? null;

        if (class_exists($controllerName)) {
            $this->currentController = new $controllerName();
            unset($url[0]);
        } else {
            $this->currentController = "app\controllers\\$this->currentController";
            $this->currentController = new $this->currentController();
        }

        if ($actionName && method_exists($this->currentController, $actionName)) {
            $this->currentAction = $actionName;
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func([$this->currentController, $this->currentAction], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return false;
    }

}