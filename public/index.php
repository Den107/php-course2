<?php
class User
{
  protected int $id;
  public string $nickName;
  protected string $login;
  protected string $password;
  static protected string $role;
  public string $avatar;

  public function setPassword($pass)
  {
    $this->password = $pass;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setLogin($login)
  {
    $this->login = $login;
  }

  public function getLogin()
  {
    return $this->login;
  }

  static public function setRole($role)
  {
    self::$role = $role;
  }

  static public function getRole()
  {
    return self::$role;
  }
}



$man = new User();

var_dump($man);
