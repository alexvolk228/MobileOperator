<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание услуги</title>
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
        <section class = "new new-usl">
        <h3>Добавление новой услуги</h3>
        <form class = "usl-form" action="server/newUsl.php" method = "post">
        <p class = "field">
        <label for="nameUsl">Название услуги: </label>
        <input class = "name" name = "nameUsl" type="text">
        </p>
        <p class = "field">
        <label for="descrUsl">Описание услуги: </label>
        <textarea class = "descr" type="text" name = "descrUsl"></textarea>
        </p>
        <p class = "field">
        <label for="priceUsl">Стоимость: </label>
        <input class = "price" type="text" name = "priceUsl">
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