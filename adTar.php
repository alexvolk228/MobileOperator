<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание тарифа</title>
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
        <section class = "new new-tar">
        <h3>Добавление нового тарифа</h3>
        <form class = "tar-form" action="server/newTar.php" method = "post">
        <p class = "field">
        <label for="name">Название тарифа: </label>
        <input class = "name" name = "name" type="text">
        </p>
        <p class = "field">
        <label for="descr">Описание тарифа: </label>
        <textarea class = "descr" type="text" name = "descr"></textarea>
        </p>
        <p class = "field">
        <label for="price">Стоимость: </label>
        <input class = "price" type="text" name = "price">
        </p>
        <p class = "field">
        <label for="min">Минуты: </label>
        <input class = "min" type="text" name = "min">
        </p>
        <p class = "field">
        <label for="net">Интернет: </label>
        <input class = "net" type="text" name = "net">
        </p>
        <p class = "field">
        <label for="mess">Сообщения: </label>
        <input class = "mess" type="text" name = "mess">
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