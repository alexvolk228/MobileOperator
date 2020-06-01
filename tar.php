<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тарифы</title>
    <link href ="css/style.css" rel="stylesheet"> 
</head>
<body>
<header class="main-header">
        <nav class="main-nav">
        <ul class="main-nav-list">
            <li><a href="index.php" title="На главную">VolkTelecom</a></li>
            <li><a href="#"title= "Тарифы">Тарифы</a></li>
            <li><a href="usl.php" title="Услуги">Услуги</a></li>
            <?php
            if ($_COOKIE['user'] == '' && $_COOKIE['sotr'] == '' && $_COOKIE['SotrCall'] == ''):
            ?>
            <li><a href="per.php" title="Вход" class = "login-link">Вход</a></li>
            <?php else: ?>
                <li><a href="per.php" title="Личный кабинет" class = "login-link">Личный кабинет</a></li>
                <li><a href="server/exit.php">Выход</a></li>
        <?php endif;?>
        </ul>
    </nav>
    </header>
    <main>
    <main class="content">
        <?php
        $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
        if ($connection == false) {
            echo 'Не удалось подключиться к БД';
            echo my_sql_connect_error();
            exit();
        }
        ?>
    <h2>Тарифы</h2>
    <section class="tariffs only-tar">
            <?php
            $tariffs = mysqli_query($connection, "SELECT * FROM Тариф ");

            while (($tar = mysqli_fetch_assoc($tariffs))) {
                echo '<div class="card">
                <p class = "heading">' . $tar['НазваниеТарифа'] .'</p><hr>';
                if ($tar['ОписаниеТарифа']) {
                echo '<p class = "descr">' . $tar['ОписаниеТарифа'] . '</p>';
                }
                echo '<ul><li>Цена: ' . $tar['СтоимостьТарифа'] . ' руб</li>'.
                '<li>Минуты: ' . $tar['Минуты'] . ' мин</li>'.
                '<li>Интернет: ' . $tar['Интернет'] . ' Гб</li>';
                if ($tar['Сообщения']) {
                echo '<li>Сообщения: ' . $tar['Сообщения'] . ' шт</li>';
                }
                echo '</ul>' . 
                '<form action = "" method="post">
                <input type = "text" class = "visually-hidden" name = "tar-id" value = "' . $tar['НомТарифа'] .'">';
                if ($_COOKIE['user'] != '') {
                    $ptr = $tar['НомТарифа'];
                    $us_id = $_COOKIE['UsID'];
                    $sql = mysqli_query($connection, "SELECT НомерТел FROM Номер WHERE UserID = '$us_id' AND НомТарифа <> '$ptr'");
                    if ($sql->num_rows != 0) {
                    echo '<p class = "field">
                    <label class = "lbnumb" for="number">Номер телефона: </label>
                    <select class = "sNumber" name = "number" type="text">';
                    echo '<option>';if($_POST['number'] != '') { 
                        echo $_POST['number'];
                    }
                    echo '</option>';


                            
                            $numbers = mysqli_query($connection, "SELECT НомерТел FROM Номер WHERE UserID = '$us_id' AND НомТарифа <> '$ptr'");
                            
                            
                            while (($numb = mysqli_fetch_assoc($numbers))) {
                              
                                if($_POST['number'] != $numb['НомерТел']) {
                                echo '<option>' . $numb['НомерТел'] . '</option>';
                                }
                            }
                            
                    echo '</select>
                    </p>';
                        }
                
                $numbers = mysqli_query($connection, "SELECT НомерТел FROM Номер WHERE UserID = '$us_id' AND НомТарифа <> '$ptr'");
                if ($numbers->num_rows != 0) {
                    if (($_COOKIE['sotr'] != '' && $_COOKIE['SotrCall'] != '') || ($_COOKIE['user'] != '')) {
                    echo '<button class="btn-connect" type = "submit" formaction = "server/changeTar.php">Подключить</button>';
                    }
                }
                else {
                    echo '<p style = "font-size: 18px; position: relative; bottom: 0; color: aqua; text-align:center;">У вас уже подключен этот тариф</p>';
                }
            }
            else {
                if ($_COOKIE['sotr'] != '' && $_COOKIE['SotrCall'] != '') {
                echo '<button class="btn-connect" type = "submit" formaction = "server/changeTar.php">Подключить</button>';
                }
            }
                echo '</form>
                </div>';
            
            }
            ?>
            </section>
            <?php
        mysqli_close($connection);
        ?>
        <section class="modal modal-login">
        <h2>Личный кабинет</h2>
        <p class="modal-description">Введите пожалуйста свой логин и пароль</p>
        <form class="login-form" action="server/auth.php" method="post" onsubmit = "return validate();">
            <p>
                <label class="visually-hidden" for="user-login">Логин</label>
                <input class="login-icon-user" id="user-login" type="text" name="login" placeholder="Логин">
            </p>
            <p>
                <label class="visually-hidden" for="user-password">Пароль</label>
                <input class="login-icon-password" id="user-password" type="password" name="pass" placeholder="Пароль">
            </p>
            <!-- <p class="login-help">
                <label class="login-checkbox">
                    <input type="checkbox" name="remember" class="visually-hidden">
                    <span class="checkbox-indicator"></span>
                    Запомните меня
                </label>
                <a class="restore" href="#">Я забыл пароль!</a>
            </p> -->
            <button class="button-enter" type="submit">Войти</button>
        </form>
        <button class="modal-close" type="button">Закрыть</button>
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
    <?php
            if ($_COOKIE['user'] == '' && $_COOKIE['sotr'] == '' && $_COOKIE['SotrCall'] == ''):
            ?>
    <script src = 'js/script.js'></script>
    <?php endif;?>
</body>
</html>