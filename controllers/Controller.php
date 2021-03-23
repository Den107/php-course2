<?php

namespace app\controllers;

use app\base\Application;
use app\exceptions\ActionNotFoundException;
use app\interfaces\RendererInterface;
use app\models\records\Menu;
use app\models\Auth;
use app\models\repositories\MenuRepository;

abstract class Controller
{
    protected $action = null;
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';
    protected $renderer = null;
    protected $request = null;



    protected $auth;

    public function __construct()
    {
        $this->request = Application::getInstance()->request;
        $this->renderer = Application::getInstance()->renderer;
        $this->auth = Application::getInstance()->auth;
    }

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new ActionNotFoundException("Указанный action не найден!");
        }
    }


    protected function getLayoutParams(): array
    {
        $menuAccessLevel = [0];
        if ($user = $this->auth->getCurrentUser()) {
            $menuAccessLevel[] = 2;
        } else {
            $menuAccessLevel[] = 1;
        }
        $menu = (new MenuRepository())->getOrderedList($menuAccessLevel);
        return ['menu' => $menu];
    }


    public function render(string $template, array $params = [])
    {
        $content = $this->renderer->render($template, $params);
        if ($this->useLayout) {
            $params = $this->getLayoutParams();
            $params['content'] = $content;
            return $this->renderer->render('layouts/' . $this->defaultLayout, $params);
        }
        return $content;
    }


    public function redirect(string $url)
    {
        header("Location: {$url}");
        exit();
    }


    public function redirectToReferer()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
