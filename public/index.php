<?php
// Task1,2,3,4
class User
{
  protected int $id;
  public string $nickName;
  protected string $login;
  protected string $password;
  static protected string $role;
  public string $avatar;

  public function __construct($id, $nickName)
  {
    $this->id = $id;
    $this->nickName = $nickName;
  }

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
}

class Admin extends User
{
  static protected string $role = 'Admin';

  private function addProduct($product)
  {
    //добавляет товар в магазин
  }
  private function removeProduct($product)
  {
    //удаляет товар из магазина
  }

  private function addUser()
  {
    //добавляет юзера
  }
  private function removeUser()
  {
    //удаляет юзера
  }

  private function setDiscount($user, $discount)
  {
    //дать определенному юзеру определенную скидку
  }
  private function removeDiscount($user, $discount)
  {
    //удалить определенному юзеру определенную скидку
  }
}

class Client extends User
{
  static protected string $role = 'Client';
  private array $bascket = [];
  private array $order;
  private $discount;

  private function addToBascket($product, $countProduct)
  {
    //добавить товар в корзину
  }
  private function removeOfBascket($product, $countProduct)
  {
    //удалить товар из корзины
  }

  private function checkout(array $bascket)
  {
    $this->order = $bascket; // оформить покупку
  }

  private function applyDiscount()
  {
    //применить свою скидку
  }
}


$man = new User(1, 'Chuvak');
echo '<pre>';
var_dump($man);


//Task5
class A
{
  public function foo()
  {
    static $x = 0;
    echo ++$x;
  }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); //выведет 1, так как переменная x статична для класса, следовательно каждый вызов функции будет увеличивать x на 1, внезависимости от объекта, вызывающего эту функцию
$a2->foo(); //2
$a1->foo(); //3
$a2->foo(); //4

//Task6
class B
{
  public function foo()
  {
    static $x = 0;
    echo ++$x;
  }
}
class C extends B
{
}
$a1 = new B();
$b1 = new C();
$a1->foo(); //выведет 1, так как переменная x статична для своего класса, в классе С своя x, в классе В своя, значит объект а1 имеет свою x, а объект в1 свою
$b1->foo(); //1
$a1->foo(); //2
$b1->foo();//2
