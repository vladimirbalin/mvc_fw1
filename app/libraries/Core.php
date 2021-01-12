<?php

namespace app\libraries;

use app\config\Config;

class Core
{
    protected $currentController = 'PagesController';
    protected $currentAction = 'index';
    protected $params = [];

    public function __construct(Config $config)
    {
        $url = $this->getUrl();

        $controllerName = ucfirst($url[0]) . 'Controller';
        $actionName = $url[1];

        if (file_exists("../app/controllers/$controllerName.php")) {
            $this->currentController = $controllerName;
            unset($url[0]);
        };

        require_once "../app/controllers/$this->currentController.php";
        $this->currentController = new $this->currentController();

        if ($actionName && method_exists($this->currentController, $actionName)) {
            $this->currentAction = $actionName;
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func([$this->currentController, $this->currentAction], $this->params);

        foreach ($config as $constant => $value) {
            $$constant = $value;
        }
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