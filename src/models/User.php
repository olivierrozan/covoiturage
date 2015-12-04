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
        $query = "SELECT * FROM " . $this->table . " WHERE login = ? AND password = ?";
        $result = $this->dbQuery($query, array($login, $password))->fetch();
        
        if (!empty($result)) {
            $_SESSION["uid"] = $result["id"];
        }
    }
    
    public function Created($email, $nom, $prenom, $tel)
    {
        $query = "INSERT INTO user (email, login, password, nom, prenom, tel) VALUES (?, ?, ?, ?, ?, ?)";
        
        $login = $prenom[0].$nom;
        $mdp = "";

        for ($i = 1; $i <= 6; $i++) {
            do {
               $n = rand(49, 122); 
            } while ( ($n > 57 && $n < 65) || ($n > 90 && $n < 97) );

            $mdp = $mdp.chr($n);
        }
        
        $result = $this->dbQuery($query, array($email, $login, $mdp, $nom, $prenom, $tel));
        
        return $result;
    }
}
