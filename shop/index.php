<?php
require_once('models/SQL.php');
require_once('models/functions.php');
// Создаем единственный экземпляр класса для работы с БД
$db = SQL::Instance();
// Подгружаем и активируем автозагрузчик Twig-а
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();
try {
  // Указывает, где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('views');
  // Инициализируем Twig
  $twig = new Twig_Environment($loader);
  // Подгружаем шаблоны
  $header = $twig->loadTemplate('v_header.tmpl');
  $footer = $twig->loadTemplate('v_footer.tmpl');

  //передаем управление роутеру
  require_once('controllers/c_router.php');

} catch (Exception $e) {
  die('ERROR: ' . $e->getMessage());
}