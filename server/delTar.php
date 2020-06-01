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
$namTar = filter_var(trim($_POST['name']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}


$res = mysqli_query($connection, "DELETE FROM Тариф WHERE НазваниеТарифа = '$namTar'");

$check = mysqli_query($connection, "SELECT * FROM Тариф WHERE НазваниеТарифа = '$namTar'");

if ($check->num_rows == 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Тариф успешно удалён.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу со всеми тарифами.</p>';
    header('Refresh: 2; url = /tar.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу удаления тарифов.</p>';
    header('Refresh: 2; url = /dropTar.php');
}


mysqli_close($connection);

?>