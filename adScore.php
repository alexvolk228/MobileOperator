<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Пополнение баланса</title>
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
    <h3>Пополнить счёт</h3>
    <form class="pay-form" action="server/bal_user.php" method="post">
    <p class = "field">
    <label for="number">Номер телефона: </label>
    <select class = "number" id = "number" name = "number" type="text">
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
                echo '<option>' . $numb['НомерТел'] . '</option>';
            }
            ?>
    </select>
    </p>
    <p class = "field">
    <label for="card-num">Номер карты: </label>
    <input class = "card-num" id = "card-num" type="text" name = "card-num" placeholder = "Номер карты">
    </p>
    <p class = "field">
    <label for="sum-pay">Сумма платежа: </label>
    <input class = "sum-pay" id = "sum-pay" type="text" name = "sum-pay" placeholder = "100">
    </p>
    <button class = "btn-pay" type = "submit">Пополнить</button>
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