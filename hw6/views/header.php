<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Пегий дудочник</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container container-main">
        <div class="header"> <a href="index.html" class="logo">Пегий дудочник</a>
            <ul class="menu">
                <li><a href="?page=home">Главная</a></li>
                <li><a href="?page=catalog">Каталог</a></li>
                <li><a href="?page=contacts">Контакты</a></li>
                <?php if ($_SESSION['login'] == 'admin') : ?>
                    <li><a href="?page=admin">Управление</a></li>
                <?php else : ?>
                    <li><a href="?page=cart">Корзина</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['login']) : ?>
                    <li><a href="index.php?exit=true">Выход</a></li>
                <?php else : ?>
                    <li><a href="index.php?page=login">Вход</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="content">