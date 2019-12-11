<?
class M_User extends BaseModel{
  function __construct($login, $pass, $name)
  {
    $this->login = $login;
    $this->pass = $pass;
    $this->name = $name;
  }
	public function auth($login, $pass) {
    if (($login == $this->login) && ($pass == $this->pass)) return true;
    else return false;
  }
}