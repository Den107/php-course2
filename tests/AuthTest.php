<?php

use app\models\Auth;

class AuthTest extends \PHPUnit\Framework\TestCase
{
  public function testauthById()
  {
    $auth = new \app\models\Auth();
    $this->assertEquals(true, $auth->authById(1));
  }

  public function testGetCurrentUser()
  {
    $auth = new \app\models\Auth();
    $auth::currentUser = 'User1';
    $this->assertEquals(Auth::currentUser, $auth->getCurrentUser());
  }
}
