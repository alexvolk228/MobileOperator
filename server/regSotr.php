<style>
p {
    font-family: 'Roboto', sans-serif;
    text-align: center;
}
p:first-child {
    margin-top: 50px;
}

</style>
<?php
$fioSotr = filter_var(trim($_POST['name']),
FILTER_SANITIZE_STRING);
$dolSotr = filter_var(trim($_POST['dol']),
FILTER_SANITIZE_STRING);
$passSotr = filter_var(trim($_POST['pass']),
FILTER_SANITIZE_STRING);



$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}
if ($fioSotr != "") {
    if ($dolSotr != "") {
        if ($passSotr != "") {
            $passSotr = md5($passSotr);
$res = mysqli_query($connection, "INSERT INTO Сотрудник (ФИОсотрудника, Должность, ПарольСотр) 
VALUES ('$fioSotr', '$dolSotr', '$passSotr')");
        }
    }
}

$check = mysqli_query($connection, "SELECT * FROM Сотрудник WHERE ФИОсотрудника = '$fioSotr' 
AND Должность = '$dolSotr' AND ПарольСотр = '$passSotr'");

if ($check->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Сотрудник успешно добавлен.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу со всеми сотрудниками.</p>';
    header('Refresh: 2; url = /regOrDelSotr.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу добавления сотрудника.</p>';
    header('Refresh: 2; url = /regOrDelSotr.php');
}

mysqli_close($connection);
?>