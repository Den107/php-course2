<?php

namespace app\controllers;

class ProductController
{
  protected $action = null;
  protected $defaultAction = 'index';

  public function run($action = null)
  {
    $this->action = $action ?: $this->defaultAction;
    $method = 'action' . ucfirst($this->action);
    if (method_exists($this, $method)) {
      $this->$method();
    } else {
      echo '404';
    }
  }

  public function actionIndex()
  {
    echo 'catalog';
  }

  public function actionCard()
  {
    echo 'card';
  }

  function renderTemplate(string $templateName, array $params = []): string
  {
    //extract(prepareViewParams());
    extract($params);
    ob_start();
    return ob_get_clean();
  }

  function render(string $template, array $params = [], $useLayout = true)
  {
    $content = $this->renderTemplate($template, $params);
    if ($useLayout) {
      return $this->renderTemplate('layouts/main', ['content' => $content]);
    }
    return $content;
  }
}
