<?php

namespace app\models;

use app\base\Application;
use app\base\Session;
use app\models\records\User;
use app\models\repositories\UserRepository;


class Auth
{
  /** @var User */
  protected $currentUser = null;
  /** @var Session  */
  protected $session = null;

  public function __construct()
  {
    $this->session = Application::getInstance()->session;
  }



  public function authById(int $userId): bool
  {
    $this->session->set('user_id', $userId);
    return true;
  }


  public function getCurrentUser(): ?User
  {
    if (is_null($this->currentUser)) {
      if ($userId = $this->session->get('user_id')) {
        $this->currentUser = (new UserRepository())->getById($userId);
      }
    }
    return $this->currentUser;
  }


  public function logout()
  {
    $this->session->remove('user_id');
    $this->session->destroy();
  }
}
