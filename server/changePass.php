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
$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$oldPass = filter_var(trim($_POST['oldPass']),
    FILTER_SANITIZE_STRING);
    $newPass = filter_var(trim($_POST['newPass']),
    FILTER_SANITIZE_STRING);
    $rep = filter_var(trim($_POST['rep']),
    FILTER_SANITIZE_STRING);
    $oldPass = md5($oldPass);
    $newPass = md5($newPass);
    $rep = md5($rep);

if ($_COOKIE['sotr'] || $_COOKIE['SotrCall']) {
    

    if ($_COOKIE['sotr']) {
        $ad_ID = $_COOKIE['StID'];
        $sql = mysqli_query($connection, "SELECT ПарольСотр FROM Сотрудник WHERE ID_Sotr = '$ad_ID'");
    }
    else {
        $ad_ID = $_COOKIE['SotrCallID'];
        $sql = mysqli_query($connection, "SELECT ПарольСотр FROM Сотрудник WHERE ID_Sotr = '$ad_ID'");
    }
    $fetch = mysqli_fetch_assoc($sql);
    $pass = $fetch['ПарольСотр'];
    $check = mysqli_query($connection, "SELECT ПарольСотр FROM Сотрудник WHERE ПарольСотр = '$newPass'");

    if (($oldPass == $pass && $rep == $newPass) && $oldPass != "" && $newPass != "" && $rep != "" && $check->num_rows == 0) {
        $res = mysqli_query($connection, "UPDATE Сотрудник SET ПарольСотр = '$newPass' WHERE ID_Sotr = '$ad_ID'");
        echo '<p style = "color: rgb(109, 199, 20);">Пароль успешно изменён.</p>';
        echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
        header('Refresh: 2; url = /per.php');
    }
    else {
        echo '<p style = "color: red;">Произошла ошибка!</p>';
        echo ' <p>Через 2 сек мы перенаправим вас на страницу изменения пароля.</p>';
        header('Refresh: 2; url = /newPass.php');
    }
}

else if ($_COOKIE['user']) {
    $us_ID = $_COOKIE['UsID'];
    $sql = mysqli_query($connection, "SELECT ПарольАбон FROM Абонент WHERE UserID = '$us_ID'");
    $fetch = mysqli_fetch_assoc($sql);
    $pass = $fetch['ПарольАбон'];

    if ($oldPass == $pass && $rep == $newPass) {
        $res = mysqli_query($connection, "UPDATE Абонент SET ПарольАбон = '$newPass' WHERE UserID = '$us_ID'");
        echo '<p style = "color: rgb(109, 199, 20);">Пароль успешно изменён.</p>';
        echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
        header('Refresh: 2; url = /per.php');
    }
    else {
        echo '<p style = "color: red;">Произошла ошибка!</p>';
        echo ' <p>Через 2 сек мы перенаправим вас на страницу изменения пароля.</p>';
        header('Refresh: 2; url = /newPass.php');
    }
}
mysqli_close($connection);

?>