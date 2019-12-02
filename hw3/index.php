<?php

// Подгружаем и активируем автозагрузчик Twig-а
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();
try {
  // Указывает, где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');
  // Инициализируем Twig
  $twig = new Twig_Environment($loader);
  // Подгружаем шаблоны
  $header = $twig->loadTemplate('header.tmpl');
  $content = $twig->loadTemplate('content.tmpl');
  $footer = $twig->loadTemplate('footer.tmpl');

  // получаем массив для контента
  require_once('engine/get_photo.php');
  $items = get_photo($connection);
  $isSingle = isset($_GET['id']);

  // Передаем в шаблон переменные и значения
  // Выводим сформированное содержание
  echo $header->render(array(
    'title' => 'Галерея',
  ));
  echo $content->render(array(
    'items' => $items,
    'isSingle' => $isSingle,
  ));
  echo $footer->render(array(
    'name' => 'Подвал сайта'
  ));
} catch (Exception $e) {
  die('ERROR: ' . $e->getMessage());
}
