<?php

namespace app\base;


class Request
{
  protected $requestString = '';
  protected $controllerName = null;
  protected $actionName = null;
  protected $isPost = false;
  protected $isGet = true;
  protected $isAjax = false;



  protected $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<get>.*)#ui";


  public function __construct()
  {
    $this->requestString = $_SERVER['REQUEST_URI'];
    $this->parseRequestString();
  }


  protected function parseRequestString()
  {
    if (preg_match_all($this->pattern, $this->requestString, $matches)) {
      $this->controllerName = $matches['controller'][0];
      $this->actionName = $matches['action'][0];
    }
  }

  public function getControllerName(): ?string
  {
    return $this->controllerName;
  }

  public function getActionName(): ?string
  {
    return $this->actionName;
  }

  public function get(string $name)
  {
    return $_GET[$name];
  }

  public function post(string $name)
  {
    return $_POST[$name];
  }

  public function param(string $name)
  {
    return $_REQUEST[$name];
  }

  public function getMethod()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      return 'POST';
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      return 'GET';
    }
    if ($_SERVER['REQUEST_METHOD'] === 'AJAX') {
      return 'AJAX';
    }
  }
}
