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
$sotrId = filter_var(trim($_POST['id']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$res = mysqli_query($connection, "DELETE FROM Сотрудник WHERE ID_Sotr = '$sotrId'");

$check = mysqli_query($connection, "SELECT * FROM Сотрудник WHERE ID_Sotr = '$sotrId'");

if ($check->num_rows == 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Сотрудник успешно удалён.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу со всеми сотрудниками.</p>';
    header('Refresh: 2; url = /regOrDelSotr.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу удаления сотрудника.</p>';
    header('Refresh: 2; url = /regOrDelSotr.php');
}

mysqli_close($connection);
?>