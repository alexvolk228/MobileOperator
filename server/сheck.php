<?php
$login = filter_var(trim($_POST[$login]),
FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST[$pass]),
FILTER_SANITIZE_STRING);

if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo 'Недопустимая длина логина';
    exit();
}
else if (mb_strlen($pass) < 2 || mb_strlen($login) > 10) {
    echo 'Недопустимая длина пароль от 2 до 10';
    exit();
}
$pass = md5($pass, "sgvhsdbhj");

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$service = mysqli_query($connection, "INSERT INTO Абонент ('ФИО', 'СерияПаспорта', 'НомерПаспорта') 
VALUES ('', '', '', '')");

mysqli_close($connection);

header('Location: /');
?>