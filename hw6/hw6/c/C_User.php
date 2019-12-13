<?php
//
// Конттроллер страницы чтения.
//

include_once('m/M_User.php');

class C_User extends C_Base
{
	//
	// Конструктор.
	//

	public function action_auth()
	{
		$user = new M_User('user', '123', 'Василий');
		if ($this->IsPost()) {
			$login = $_POST['name'];
			$pass = $_POST['password'];
			if ($user->auth($login, $pass)) $_SESSION['name'] = $user->name;
		}
		$this->title .= '::Авторизация';
		$name = $_SESSION['name'];
		if ($name) $enter = true;
		$history = ['Страница 1'=>'http://yandex.ru', 'Страница 2'=>'http://google.ru'];
		$this->content = $this->Template('v/v_lk.php', array('enter' => $enter, 'user' => $name, 'history' => $history));
	}

	public function action_exit()
	{
		session_destroy();
		$this->title .= '::Выход';
		$text = 'Заходите к нам снова!';
		$this->content = $this->Template('v/v_index.php', array('text' => $text));
	}
}
