<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление абонента</title>
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
    <main class="content">
        <section class = "new new-ab">
        <h3>Добавление нового абонента</h3>
        <form class = "new-ab-form" action="server/newUser.php" method = "post">
        <p class = "field">
        <label for="namUser">ФИО: </label>
        <input class = "name" name = "namUser" type="text">
        </p>
        <p class = "field">
        <label for="serUser">Серийный номер паспорта: </label>
        <input class = "serPass" type="text" name = "serUser"></input>
        </p>
        <p class = "field">
        <label for="numbUser">Номер паспорта: </label>
        <input class = "numbPass" type="text" name = "numbUser">
        </p>
        <p class = "field">
        <label for="passUser">Пароль: </label>
        <input class = "pass" type="password" name = "passUser">
        </p>
        <p class = "field">
        <label for="phoneUser">Номер телефона: </label>
        <input class = "phone" type="text" name = "phoneUser">
        </p>
        <p class = "field">
        <label for="tarUser">Тариф: </label>
        <select class = "tar" type="text" name = "tarUser">
            <?php
             $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
             if ($connection == false) {
                 echo 'Не удалось подключиться к БД';
                 echo my_sql_connect_error();
                 exit();
             }
            $tariffs = mysqli_query($connection, "SELECT НазваниеТарифа FROM Тариф ");

            while (($tar = mysqli_fetch_assoc($tariffs))) {
                echo '<option class = "tariff">' . $tar['НазваниеТарифа'] . '</option>';
            }
            ?>
        </select>
        </p>
        <button class = "btn-ins" type = "submit">Добавить</button>
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