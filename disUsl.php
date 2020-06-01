<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отключение услуг</title>
    <link href ="css/style.css" rel="stylesheet"> 
</head>
<body>
<header class="main-header">
        <nav class="main-nav">
        <ul class="main-nav-list">
            <li><a href="index.php" title="На главную">VolkTelecom</a></li>
            <li><a href="tar.php"title= "Тарифы">Тарифы</a></li>
            <li><a href="usl.php" title="Услуги">Услуги</a></li>
                <li><a href="per.php" title="Личный кабинет" class = "login-link">Личный кабинет</a></li>
                <li><a href="server/exit.php">Выход</a></li>
        </ul>
    </nav>
    </header>
    <main>
    <main class="content">
    <section class = "plus-score">
    <h3>Отключить услугу</h3>
    <form class="pay-form" action="" name = "frm" method="post">
    <p class = "field">
    <label for="number">Номер телефона: </label>
    <select class = "number" id = "number" name = "number" onChange = "document.frm.submit();" type="text">
    <option><?php  if($_POST['number'] != '') { echo $_POST['number'];}?></option>
    <?php

             $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
             if ($connection == false) {
                 echo 'Не удалось подключиться к БД';
                 echo my_sql_connect_error();
                 exit();
             }
            $us_id = $_COOKIE['UsID'];
            $numbers = mysqli_query($connection, "SELECT НомерТел FROM Номер WHERE UserID = '$us_id' ");

            while (($numb = mysqli_fetch_assoc($numbers))) {
                if($_POST['number'] != $numb['НомерТел']) {
                echo '<option>' . $numb['НомерТел'] . '</option>';
                }
            }
            ?>
    </select>
    </p>
    <p class = "field">
    <label for="usl">Название услуги: </label>
    <select class = "usl" id = "usl" name = "usl" type="text" onChange = "">
    <?php
            $uslNum = $_POST['number'];
            $usl = mysqli_query($connection, "SELECT НазваниеУслуги FROM УслугиНомера WHERE НомерТел IN (SELECT НомерТел FROM Номер WHERE НомерТел = '$uslNum')");
            switch ($uslNum) {
                case '': break;
                case $uslNum: 
                    while (($res = mysqli_fetch_assoc($usl))) {
                        echo '<option>' . $res['НазваниеУслуги'] . '</option>';
                    }
                break;
            }
            ?>
    </select>
    
    </p>
    <button class = "btn-pay" type = "submit" formaction = 'server/delAbUsl.php'>Отключить</button>
    </form>
    </section>
    
    </main>
    <footer class="main-footer">
        <div class="footer-content">
        <div id="social">
            <a href="http://vk.com" title="Группа ВК" target="_blank">
                <img src="img/vk.png" alt="ВК" width="30px" height="30px">
            </a>
            <a href="https://twitter.com" title="Твиттер"target="_blank">
            <img src="img/twit.png" alt="Твиттер" width="30px" height="30px">
            </a>
        </div>
        <div id="rights">
            Все права защищены &copy 2020
        </div>
    </div>
    </footer>
</body>
</html>