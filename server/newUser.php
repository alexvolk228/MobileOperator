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
$namUser = filter_var(trim($_POST['namUser']),
FILTER_SANITIZE_STRING);
$serUser = filter_var(trim($_POST['serUser']),
FILTER_SANITIZE_STRING);
$numbUser = filter_var(trim($_POST['numbUser']),
FILTER_SANITIZE_STRING);
$passUser = filter_var(trim($_POST['passUser']),
FILTER_SANITIZE_STRING);
$phoneUser = filter_var(trim($_POST['phoneUser']),
FILTER_SANITIZE_STRING);
$tarUser = filter_var(trim($_POST['tarUser']),
FILTER_SANITIZE_STRING);

$passUser = md5($passUser);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$checknum = mysqli_query($connection, "SELECT НомерТел FROM Номер WHERE НомерТел = '$phoneUser'");

if ($phoneUser != "" && $checknum->num_rows == 0) {
$res = mysqli_query($connection, "INSERT INTO Абонент (ФИО, СерияПаспорта, НомерПаспорта, ПарольАбон)
VALUES ('$namUser', '$serUser', '$numbUser', '$passUser')");

$sql = mysqli_query($connection, "SELECT UserID FROM Абонент 
WHERE СерияПаспорта = '$serUser' AND НомерПаспорта = '$numbUser'");

$res2 = mysqli_fetch_assoc($sql);
$usId = $res2['UserID'];

$sql1 = mysqli_query($connection, "SELECT НомТарифа FROM Тариф 
WHERE НазваниеТарифа = '$tarUser'");
$res3 = mysqli_fetch_assoc($sql1);
$tarId = $res3['НомТарифа'];

$res4 = mysqli_query($connection, "INSERT INTO Номер (НомерТел, UserID, НомТарифа)
VALUES ('$phoneUser', '$usId', '$tarId')");

$check1 = mysqli_query($connection, "SELECT * FROM Абонент WHERE UserID = '$usId'");
$check2 = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$usId'");
}
if ($check1->num_rows != 0 && $check2->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Пользователь успешно добавлен.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
    header('Refresh: 2; url = /per.php');
} 
else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу добавления абонента</p>';
    header('Refresh: 2; url = /adUser.php');
}

mysqli_close($connection);


?>