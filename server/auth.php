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
$login = filter_var(trim($_POST['login']),
FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),
FILTER_SANITIZE_STRING);

$pass = md5($pass);
$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

if ($login > 1800) {
$result = mysqli_query($connection, "SELECT * FROM Абонент WHERE UserID = '$login' 
AND ПарольАбон = '$pass'");

$user = mysqli_fetch_assoc($result);

$numb = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$login' ");

$tel = mysqli_fetch_assoc($numb);

setcookie('user', $user['ФИО'], time() + 3600, "/");
setcookie('UsID', $user['UserID'], time() + 3600, "/");

}
else if ($login < 300) {
$result = mysqli_query($connection, "SELECT * FROM Сотрудник WHERE ID_Sotr = '$login' 
AND ПарольСотр = '$pass'");

$user = mysqli_fetch_assoc($result);

setcookie('sotr', $user['ФИОсотрудника'], time() + 3600, "/");
setcookie('StID', $user['ID_Sotr'], time() + 3600, "/");
setcookie('Pos', $tel['Должность'], time() + 3600, "/");
}
else {
    $result = mysqli_query($connection, "SELECT * FROM Сотрудник WHERE ID_Sotr = '$login' 
    AND ПарольСотр = '$pass'");
    
    $user = mysqli_fetch_assoc($result);
    
    setcookie('SotrCall', $user['ФИОсотрудника'], time() + 3600, "/");
    setcookie('SotrCallID', $user['ID_Sotr'], time() + 3600, "/");
    setcookie('SotrCallPos', $tel['Должность'], time() + 3600, "/");
}

if (count($user) == 0) {
    echo '<p style = "color: red;">Такой пользователь не найден!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на главную страницу</p>';
    header('Refresh: 2; url = /index.php');
}
else {
    header('Location: /per.php');
}
mysqli_close($connection);
?>