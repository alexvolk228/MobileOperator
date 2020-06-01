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
$number = filter_var(trim($_POST['number']),
FILTER_SANITIZE_STRING);
$sum = filter_var(trim($_POST['sum-pay']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}
$sql = mysqli_query($connection, "SELECT Баланс FROM Номер WHERE НомерТел = '$number'");
$fetch = mysqli_fetch_assoc($sql);
$res = $fetch['Баланс'];

$result = mysqli_query($connection, "UPDATE Номер SET Баланс = Баланс + '$sum' 
WHERE НомерТел = '$number'");

$check = mysqli_query($connection, "SELECT Баланс FROM Номер WHERE НомерТел = '$number'");
$fetch1 = mysqli_fetch_assoc($check);
$res1 = $fetch1['Баланс'];

if ($res == $res1 - $sum && $sum != "") {
    echo '<p style = "color: rgb(109, 199, 20);">Баланс успешно пополнен.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
    header('Refresh: 2; url = /per.php');
}
else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу пополнения.</p>';
    header('Refresh: 2; url = /adScore.php');
}
mysqli_close($connection);
?>