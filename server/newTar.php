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
$descrTar = filter_var(trim($_POST['descr']),
FILTER_SANITIZE_STRING);
$priceTar = filter_var(trim($_POST['price']),
FILTER_SANITIZE_STRING);
$minTar = filter_var(trim($_POST['min']),
FILTER_SANITIZE_STRING);
$netTar = filter_var(trim($_POST['net']),
FILTER_SANITIZE_STRING);
$messTar = filter_var(trim($_POST['mess']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

if ($descrTar == '' && $messTar == '') {
    $res = mysqli_query($connection, "INSERT INTO Тариф (НазваниеТарифа, СтоимостьТарифа, Минуты, Интернет) 
VALUES ('$namTar', '$priceTar', '$minTar', '$netTar')");
}
else if ($descrTar == '' && $messTar != '') {
    $res = mysqli_query($connection, "INSERT INTO Тариф (НазваниеТарифа, СтоимостьТарифа, Минуты, Интернет, Сообщения) 
    VALUES ('$namTar', '$priceTar', '$minTar', '$netTar', '$messTar')");
}
else {
    $res = mysqli_query($connection, "INSERT INTO Тариф (НазваниеТарифа, ОписаниеТарифа, СтоимостьТарифа, Минуты, Интернет) 
VALUES ('$namTar', '$descrTar', '$priceTar', '$minTar', '$netTar')");
}

$check = mysqli_query($connection, "SELECT * FROM Тариф WHERE НазваниеТарифа = '$namTar'");

if ($check->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Тариф успешно добавлен.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу с тарифами.</p>';
    header('Refresh: 2; url = /tar.php');  
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы вернём вас на страницу добавления тарифа.</p>';
    header('Refresh: 2; url = /adTar.php');
}

mysqli_close($connection);
?>