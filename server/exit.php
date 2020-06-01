<?php
setcookie('user', $user['ФИО'], time() - 3600, "/");
setcookie('UsID', $user['UserID'], time() - 3600, "/");
setcookie('UsNum', $tel['НомерТел'], time() - 3600, "/");

setcookie('sotr', $user['ФИОсотрудника'], time() - 3600, "/");
setcookie('StID', $user['ID_Sotr'], time() - 3600, "/");
setcookie('Pos', $tel['Должность'], time() - 3600, "/");

setcookie('SotrCall', $user['ФИОсотрудника'], time() - 3600, "/");
setcookie('SotrCallID', $user['ID_Sotr'], time() - 3600, "/");
setcookie('SotrCallPos', $tel['Должность'], time() - 3600, "/");

header('Location: /');
?>