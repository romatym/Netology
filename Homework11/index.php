<?php
    $pdo = new PDO("mysql:host=localhost;dbname=homework11;charset=utf8", "root", "");
    $sql = "SELECT * FROM books where true";
    if (!isset($_SESSION)) {
        $_SESSION = [];
    }
    
    if (isset($_POST['ISBN'])) {
        $ISBN_value = $_POST['ISBN'];
        $_SESSION['ISBN'] = $ISBN_value;
        $sql = $sql.' and `isbn` LIKE \'%'.$ISBN_value.'%\'';
    }
    if (isset($_POST['name'])) {
        $name_value = $_POST['name'];
        $_SESSION['name'] = $name_value;
        $sql = $sql.' and `name` LIKE \'%'.$name_value.'%\'';
    }
    if (isset($_POST['author'])) {
        $author_value = $_POST['author'];
        $_SESSION['author'] = $author_value;
        $sql = $sql.' and `author` LIKE \'%'.$author_value.'%\'';
    }
?>

<form action = "index.php" method = "post">
    <p>ISBN: <input type = "text" name = "ISBN" value = "<?php echo((isset($_SESSION['ISBN'])) ? $_SESSION['ISBN'] : "")?>" /></p>
    <p>name: <input type = "text" name = "name" value = "<?php echo((isset($_SESSION['name'])) ? $_SESSION['name'] : "")?>" /></p>
    <p>author: <input type = "text" name = "author" value = "<?php echo((isset($_SESSION['author'])) ? $_SESSION['author'] : "")?>" /></p>
    <p><input type = "submit" /></p>
</form>

<?php

if (!empty($_POST)) {
    $table = $pdo->query($sql);
    echo 'Найденные книги: '.'<br>';
    foreach ($table as $row) {
        echo $row['name'] . "<br />";
    }    
}

?>