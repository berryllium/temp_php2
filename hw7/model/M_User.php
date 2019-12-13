<?
require_once('SQL.php');
class M_User {
  function __construct($login, $pass, $name)
  {
    $this->login = $login;
    $this->pass = $pass;
    $this->name = $name;
  }
	public function auth() {
    $db = SQL::Instance();
    $login = $db->Select('users', 'login', $this->login);
    print_r($login);
    if ($this->login == $login) return true;
    else return false;
  }
}