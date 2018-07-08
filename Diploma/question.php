<?php
require_once '.\functions.php';
require_once '.\vendor\autoload.php';

session_start();

$errors = [];
$pdo = new PDO("mysql:host=localhost;dbname=diploma;charset=utf8", "root", "");

if (isset($_POST['sendQuestion'])) {
    
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $topic = filter_input(INPUT_POST, 'topic', FILTER_SANITIZE_SPECIAL_CHARS);
    $question = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_SPECIAL_CHARS);
    
    addQuestion($pdo, $category, $name, $email, $topic, $question);
}
$category = '';
if (isset($_GET['category'])) {
    $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
}
$a = getCategories($pdo);

initTwig('question.tmpl', 
        array(
        'categories'=>getCategories($pdo),
        'category'=>$category
        )
);
