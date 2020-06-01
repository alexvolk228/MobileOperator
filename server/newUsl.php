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
$namUsl = filter_var(trim($_POST['nameUsl']),
FILTER_SANITIZE_STRING);
$descrUsl = filter_var(trim($_POST['descrUsl']),
FILTER_SANITIZE_STRING);
$priceUsl = filter_var(trim($_POST['priceUsl']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$res = mysqli_query($connection, "INSERT INTO Услуга
VALUES ('$namUsl', '$descrUsl', '$priceUsl')");

$check = mysqli_query($connection, "SELECT * FROM Услуга WHERE НазваниеУслуги = '$namUsl'");

if ($check->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Услуга успешно добавлена.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу с услугами.</p>';
    header('Refresh: 2; url = /usl.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы вернём вас на страницу добавления услуг.</p>';
    header('Refresh: 2; url = /adUsl.php');
}

mysqli_close($connection);


?>