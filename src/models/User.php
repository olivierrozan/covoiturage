<?php
/**
 * Description of User
 *
 * @author rozan_000
 */
class UserModel extends Model {
    protected $table = "user";
    
    public function isAuth()
    {
        if (isset($_SESSION['uid'])) {
            return true;
        }
        
        return false;
    }
    
    public function auth($login, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE login = ? OR email = ?";
        $result = $this->dbQuery($query, array($login, $login))->fetch();
        
        if (!empty($result)) {
            $_SESSION["uid"] = $result["id"];
            $_SESSION["login"] = $login;
            $_SESSION["password"] = $password;
        }
        
        return $result;
    }
    
    public function Created($email, $nom, $prenom, $tel, $password)
    {
        $query = "INSERT INTO user (email, login, password, nom, prenom, tel) VALUES (?, ?, ?, ?, ?, ?)";
        
        $login = $this->login($prenom, $nom);
        //$mdp = $this->password();
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        
        $result = $this->dbQuery($query, array($email, $login, $hashPassword, $nom, $prenom, $tel));
        //$result = $this->dbQuery($query, array($email, $login, $password, $nom, $prenom, $tel));
    }
    
    public function listUser($login)
    {
        $query = "SELECT * FROM user WHERE login = ? OR email = ?";
        $result = $this->dbQuery($query, array($login, $login))->fetch();
        
        return $result;
    }
    
    public function login($prenom, $nom)
    {        
        return $prenom[0].$nom;
    }
    
    public function password()
    {
        $mdp = "";

        for ($i = 1; $i <= 6; $i++) {
            do {
               $n = rand(49, 122); 
            } while ( ($n > 57 && $n < 65) || ($n > 90 && $n < 97) );

            $mdp = $mdp.chr($n);
        }
        
        return $mdp;
    }
}
