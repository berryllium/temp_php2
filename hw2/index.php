<?php

// Задание 1

abstract class Product {
  abstract protected function calcFinalPrice();
  public function getPrice() {
    echo $this->calcFinalPrice() . '$';
  }
}

class digitalProduct extends Product {
  private $price = 100;
  protected function calcFinalPrice() {
    return $this->price;
  }
}

class singleProduct extends Product {
  private $price = 10;
  private $count = 10;
  protected function calcFinalPrice() {
    return $this->price * $this->count;
  }
}

class massProduct extends Product {
  private $price = 10;
  private $weight = 15;
  protected function calcFinalPrice() {
    return $this->price * $this->weight;
  }
}