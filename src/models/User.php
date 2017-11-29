<?php
/**
 * Description of User
 *
 * @author rozan_000
 */
class UserModel extends Model {
    protected $table = "user";
    
    /**
     * isAuth()
     * Teste si l'utilisateur est connecté ou non
     */
    public function isAuth()
    {
        if (isset($_SESSION['uid'])) {
            return true;
        }
        
        return false;
    }
    
    /**
     * auth()
     * Connexion de l'utilisateur
     */
    public function auth($login, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $result = $this->dbQuery($query, array($login))->fetch();
        
        return $result;
    }
    
    /**
     * Created()
     * Ajout d'un compte utilisateur dans la BDD
     */
    public function Created($email, $nom, $prenom, $tel, $password)
    {
        $query = "INSERT INTO user (email, password, nom, prenom, tel) VALUES (?, ?, ?, ?, ?)";
        
        $login = $this->login($prenom, $nom);
        //$mdp = $this->password();
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        
        $result = $this->dbQuery($query, array($email, $hashPassword, $nom, $prenom, $tel));
        //$result = $this->dbQuery($query, array($email, $password, $nom, $prenom, $tel));
    }
    
    /**
     * Created()
     * Affiche le profil d'un utilisateur
     */
    public function listUser($login)
    {
        $query = "SELECT * FROM user WHERE email = ?";
        $result = $this->dbQuery($query, array($login))->fetch();
        
        return $result;
    }
    
    /**
     * login()
     * Création d'un login
     */
    public function login($prenom, $nom)
    {        
        return $prenom[0].$nom;
    }
    
    /**
     * password()
     * Création d'un mot de passe
     */
    public function password()
    {
        $mdp = "efficient";

        /*for ($i = 1; $i <= 6; $i++) {
            do {
               $n = rand(49, 122); 
            } while ( ($n > 57 && $n < 65) || ($n > 90 && $n < 97) );

            $mdp = $mdp.chr($n);
        }*/
        
        return $mdp;
    }
}
