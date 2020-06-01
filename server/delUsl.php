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
$namUsl = filter_var(trim($_POST['name']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}


$res = mysqli_query($connection, "DELETE FROM Услуга WHERE НазваниеУслуги = '$namUsl'");

$check = mysqli_query($connection, "SELECT * FROM Услуга WHERE НазваниеУслуги = '$namUsl'");

if ($check->num_rows == 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Услуга успешно удалёна.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу со всеми услугами.</p>';
    header('Refresh: 2; url = /usl.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу удаления услуг.</p>';
    header('Refresh: 2; url = /dropUsl.php');
}

mysqli_close($connection);

?>