<?php


// Задание 1

abstract class Product
{
  abstract protected function calcFinalPrice();
  public function getProfit()
  {
    echo 'profit: ' . $this->calcFinalPrice() * $this->markup;
  }
  public $name;
  private $price;
  public $markup;
  public function getInfo()
  {
    echo $this->name . ' стоит ' . $this->calcFinalPrice() . '$<br>';
  }
}

class digitalProduct extends Product
{
  public function __construct($name, $price, $markup)
  {
    $this->name = $name;
    $this->price = $price;
    $this->markup = $markup;
  }
  protected function calcFinalPrice()
  {
    return $this->price;
  }
}

class singleProduct extends Product
{
  private $count;
  public function __construct($name, $price, $count, $markup)
  {
    $this->name = $name;
    $this->price = $price;
    $this->count = $count;
    $this->markup = $markup;
  }
  protected function calcFinalPrice()
  {
    return $this->price * $this->count;
  }
}

class massProduct extends Product
{
  private $weight;
  public function __construct($name, $price, $weight, $markup)
  {
    $this->name = $name;
    $this->price = $price;
    $this->weight = $weight;
    $this->markup = $markup;
  }
  protected function calcFinalPrice()
  {
    return $this->price * $this->weight;
  }
}

$digit = new digitalProduct('Видеокурс Основы ООП', 200, 0.15);
$partMon = new singleProduct('Партия мониторов', 200, 12, 0.15);
$potatos = new massProduct('Мешок картофеля', 0.5, 15, 0.15);

$digit->getInfo();
$partMon->getInfo();
$potatos->getInfo();
$partMon->getProfit();

// Задание 2

trait MyTrait
{
  public function getInstance($arg)
  {
    if ($arg === null) {
      $arg = new self;
    }
    return self::$_instance;
  }
}

class someClass
{
  use MyTrait;
  protected static $_instance;
  private function __construct()
  {
    $this->getInstance(self::$_instance);
  }
  private function __clone()
  { }
  private function __wakeup()
  { }
}
