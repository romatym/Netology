<?php
// подгружаем и активируем авто-загрузчик Twig-а
//require_once 'Twig/Autoloader.php';
//Twig_Autoloader::register();
require_once 'C:\xampp\htdocs\Netology\Homework16\vendor\autoload.php';

try {
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');

  // инициализируем Twig
  $twig = new Twig_Environment($loader, array(
    'cache'       => 'compilation_cache',
    'auto_reload' => true
    ));

  // подгружаем шаблон
  $template = $twig->loadTemplate('tasks2.tmpl');

  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  echo $template->render(array(
    'name' => 'Clark Kent',
    'username' => 'ckent',
    'password' => 'krypt0n1te',
  ));

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>