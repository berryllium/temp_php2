<?
class User {
  private $sault = 'wtrw4q42';
  private $login;
  private $pass;
  function __construct($db, $login, $pass)
  {
    $this->login = $login;
    $this->pass = $pass;
    $this->db = $db;
  }
	public function auth() {
    $user = $this->db->Select('users', 'login', $this->login);
    if($user['pass'] == md5($this->pass . $this->sault)) return true;
    else return false;
  }
  public function getLogin() {
    return $this->login;
  }
}