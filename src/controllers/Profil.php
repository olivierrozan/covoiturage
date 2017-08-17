<?php
/**
 * Description of User
 *
 * @author rozan_000
 */

require_once($rootPath . "models/User.php");
require_once($rootPath . "models/Profil.php");

class ProfilController extends Controller {
    protected $template = "views/login.html.php";
    protected $templateData = array();
    protected $title = "";
    protected $profil = array();
    
    /**
     * profilAction()
     * Donne accès au profil de l'utilisateur connecté
     */
    public function profilAction()
    {
        $this->title = "Informations du profil";
        
        $user = new UserModel();
        
        $this->profil = $user->listUser($_SESSION['login'], $_SESSION['password']);
             
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $this->template = "views/profil.html.php";
    }
    
    /**
     * modifierprofilAction()
     * Permet de modifier les informations de l'utilisateur connecté
     */
    public function modifierprofilAction()
    {
        $this->title = "MODIFIER PROFIL";
        
        $user = new UserModel();
        
        $this->profil = $user->listUser($_SESSION['login'], $_SESSION['password']);
             
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $this->template = "views/modifierprofil.html.php";
    }
    
    /**
     * modifierprofilAction()
     * Permet de modifier les informations de l'utilisateur connecté
     */
    public function updateprofilAction()
    {
        $user = new UserModel();
        $profil = new ProfilModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $email = $_POST["email"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $tel = $_POST["tel"];
        $adresse = $_POST["adresse"];
        $codePostal = $_POST["codePostal"];
        $ville = $_POST["ville"];
        $voiture = $_POST["voiture"];
        $places = $_POST["places"];
        
        $infos = $_POST;
        
        
        //$profil->updateProfil($_SESSION['uid'], $email, $nom, $prenom, $tel);
        $profil->updateProfil($_SESSION['uid'], $infos);
        
        header("Location: ?controller=profil&action=profil&modif");
        
        //$this->template = "views/modifierprofil.html.php";
    }
    
    /**
     * modifiermotdepasseAction()
     * Permet de modifier le mot de passe de l'utilisateur connecté
     */
    public function modifiermotdepasseAction()
    {
        $this->title = "Modifier Mot De Passe";
        
        $user = new UserModel();
        
        $this->profil = $user->listUser($_SESSION['login'], $_SESSION['password']);
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $infos = $_POST;
                
        $this->template = "views/modifiermotdepasse.html.php";
    }
    
    /**
     * updatepasswordAction()
     * execute la requete de modification le mot de passe de l'utilisateur connecté
     */
    public function updatepasswordAction()
    {
        $this->title = "Modifier Mot De Passe";
        
        $user = new UserModel();
        $profil = new ProfilModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $password = htmlspecialchars($_POST["password"]);
        $password2 = htmlspecialchars($_POST["confirmPassword"]);
        
        $infos = $_POST;
        
        if ($this->validatePassword($password, $password2)) {
            $profil->updatePassword($_SESSION["uid"], $infos);
            
            header('Location: ?controller=profil&action=profil&modif');
        } 
        
        //$this->template = "views/modifiermotdepasse.html.php";
    }
    
    /**
     * validatePassword()
     * Vérifie la validité du mot de passe
     */
    private function validatePassword($password, $password2)
    {
        return (
            preg_match("#[a-zA-Z0-9]{6,12}#", $password) && 
            $password === $password2
        );
    }
        
    /**
     * render()
     * Affiche le rendu du contrôleur
     * @return type
     */
    public function render()
    {
        ob_start();
        
        // Chargement du template $this->template
        $data = $this->templateData;
        $title = $this->title;
        $profil = $this->profil;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
