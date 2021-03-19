<?php

namespace app\base;

class Session
{


  public function __construct()
  {
    $this->openSession();
  }

  public function openSession()
  {
    session_start();
  }

  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function get($key, $default = null)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
  }

  public function exist($key)
  {
    return isset($_SESSION[$key]);
  }
}
