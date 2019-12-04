<?php
require_once 'model/functions.php';
$sault = 'wtrw4q42';
if ($_POST['submit']) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $query = "SELECT * FROM `users` WHERE login = '$user'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if ((md5($pass . $sault) == $row['pass'])) {
        $_SESSION['login'] = $row['login'];
        echo '<script>document.location.href = "index.php?page=welcome";</script>';
        exit;
    } else {
        echo '<p>Логин или пароль неверны!</p>';
    }
}
if ($_GET['exit']) {
    if($_SESSION['login']) session_destroy();
}
if ($_SESSION['login']) {
    echo '<script>document.location.href = "index.php?page=welcome";</script>';
    exit;
}

?>

<?php include_once 'header.php' ?>
<h2>Вход в систему</h2>
<div class="login-form">
    <form method="post">
        <label for="user">Логин: </label><input type="text" name="user" id="user" /><br />
        <label for="pass">Пароль: </label><input type="password" name="pass" id="pass" /><br />
        <input type="submit" name="submit" value="Войти" />
    </form>
    <a href="index.php?page=registration">Регистрация</a>
</div>
<?php include_once 'footer.php' ?>

<style>
    .login-form {
        width: 300px;
        height: 200px;
        margin: 200px auto;
    }

    .login-form form {
        display: flex;
        flex-direction: column;
    }
</style>