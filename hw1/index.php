<?php
header('Content-Type: text/html; charset= utf-8');

class Product
{
  private $name;
  private $category;
  private $price;

  function __construct($name, $price, $category)
  {
    $this->name = $name;
    $this->price = $price;
    $this->category = $category;
  }
  function getSpecifitaction() {
    echo "<br>Характеристики отутствуют";
  }
  function getName()
  {
    return $this->name;
  }
  function getPrice()
  {
    return $this->price;
  }
  function setPrice($price)
  {
    $this->price = $price;
  }
  function getCategory()
  {
    return $this->category;
  }
  function buy()
  {
    echo "<br>В корзину добавлен $this->name по цене $this->price $";
  }
}

$good1 = new Product('Finger', 10, 'Медиатор');

echo $good1->buy();
echo $good1->setPrice(12);
echo $good1->buy();
echo $good1->getSpecifitaction();

class Guitar extends Product
{
  private $strings;
  function __construct($name, $price, $category, $strings)
  {
    parent::__construct($name, $price, $category);
    $this->strings = $strings;
  }
  function getSpecifitaction() {
    echo "<br>Количество струн: $this->strings<br>";
  }
}
$good2 = new Guitar('Stratocaster', 2000, 'Гитары', 6);
$good2->buy();
$good2->getSpecifitaction();


// class A {
//   public function foo() {
//       static $x = 0;
//       echo ++$x;
//   }
// }
// $a1 = new A();
// $a2 = new A();
// $a1->foo();
// $a2->foo();
// $a1->foo();
// $a2->foo();
// выводит 1234, т.к. обращается к статическому свойству самого класса, 
// а поскольку $x объявлена как статическая переменная, она не обнуляется каждый раз


// class A {
//   public function foo() {
//       static $x = 0;
//       echo ++$x;
//   }
// }
// class B extends A {
// }
// $a1 = new A();
// $b1 = new B();
// $a1->foo(); 
// $b1->foo(); 
// $a1->foo(); 
// $b1->foo();
// выводит 1122, т.к. у объектов $a1 и $b1 различные родительские классы и, соответственно, стат. переменные,
// хотя и функция foo() и наследуется ими от суперкласса.

// class A {
//   public function foo() {
//       static $x = 0;
//       echo ++$x;
//   }
// }
// class B extends A {
// }
// $a1 = new A;
// $b1 = new B;
// $a1->foo();  выведет 1, т.к. статическая переменная класса A, равная нулю, увеличивается на 1 и сохраняет свое значение
// $b1->foo();  выведет 1, т.к. статическая переменная класса B, равная нулю, увеличивается на 1 и сохраняет свое значение
// $a1->foo();  выведет 2, т.к. статическая переменная класса А, равная единице, увеличивается на 1 и сохраняет свое значение
// $b1->foo();  выведет 2, т.к. статическая переменная класса B, равная единице, увеличивается на 1 и сохраняет свое значение