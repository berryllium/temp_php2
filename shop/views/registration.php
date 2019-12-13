<?php require_once 'model/functions.php';
$sault = 'wtrw4q42';
if ($_POST['submit']) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $query = "SELECT * FROM `users` WHERE login = '$login'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row['login']) echo 'Данное имя пользователя уже исользуется';
    else {
        $pass = md5($pass . $sault);
        $query = "INSERT INTO `users` (`login`, `pass`, `role`, `name`, `cart`) VALUES ('$login', '$pass', 'client', '$name', '{}')";
        $result = mysqli_query($connection, $query);
        session_start();
        $_SESSION['login'] = $login;
        echo '<script>document.location.href = "index.php?page=welcome";</script>';
    }
}
?>

<?php include_once 'header.php' ?>
<h2>Регистрация</h2>
<div class="login-form">
    <form method="post">
        <label for="name">Имя: </label><input type="text" name="name" id="name" required /><br />
        <label for="login">Логин: </label><input type="text" name="login" id="login" required /><br />
        <label for="pass">Пароль: </label><input type="password" name="pass" id="pass" required /><br />
        <input type="submit" name="submit" value="Регистрация" />
    </form>
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