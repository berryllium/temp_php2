<?php
/**
 * Шаблон авторизации
 * ================
 */
?>
<?php if ($enter === true): ?>
<h2>Личный кабинет пользователя по имени <?= $user ?></h2>
<a href="index.php?c=users&act=exit">Выйти</a>
<h3>Вы недавно смотрели</h3>
<div class="history">
	<?php foreach ($history as $key=>$value) : ?>
		<p><a href="<?= $value?>"><?= $key ?></a></p>
	<?php endforeach;?>
</div>
<?php else: ?>
<form method="post">
	<input type="text" name="name" placeholder="Ваш логин">
	<input type="password" name="password" placeholder="Ваш пароль">
	<input type="submit" name="auth" value="Войти" />
</form>
<? endif; ?>
