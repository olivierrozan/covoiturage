<?php
/**
 * Description of User
 *
 * @author rozan_000
 */

require_once($rootPath . "models/User.php");
require_once($rootPath . "forms/User.php");
require_once($rootPath . "forms/CreateUser.php");

class UserController extends Controller {
    protected $template = "views/login.html.php";
    protected $templateData = array();
    protected $title = "";
    protected $profil = array();
    protected $loginRequest = array();
    
    /**
     * createuserAction()
     * Formulaire de création d'utilisateurs
     */
    public function createuserAction()
    {
        /*$user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }*/
        
        $this->templateData["title"] = "Nouvel Utilisateur";
        $this->templateData["formAction"] = "?controller=user&action=insert";
        
        $userForm = new CreateUserForm();
        
        $this->templateData['fields'] = $userForm->fields;
        $this->template = "views/createuser.html.php";
    }
    
    /**
     * insertAction()
     * Execute la requête d'insertion d'utilisateur dans la base de données
     */
    public function insertAction()
    {
        $this->templateData['title'] = "Authentification";
        $this->title = "Created";
                
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $email = htmlspecialchars($_POST["Email"]);
        $nom = htmlspecialchars($_POST["Nom"]);
        $prenom = htmlspecialchars($_POST["Prenom"]);
        $telephone = htmlspecialchars($_POST["Telephone"]);
        $login = $user->login($prenom, $nom);
        $password = $user->password();
        
        $this->all = $user->listAll("user");
        $check = false;
        for ($i = 0; $i < count($this->all); $i++) {
            if ($this->all[$i]["email"] === $email) {
                echo "L'email existe deja.";
                $check = true;
            }
        }
        
        if ($this->validate($nom, $prenom, $email, $telephone) && !$check) {
            $user->Created($email, $nom, $prenom, $telephone, $password);
        
            $this->sendMail($login, $password, $email);
        
            header('Location: ?controller=user&action=confirm');
        } else {
            header('Location: ?controller=user&action=createuser&error');
        }
        
        $this->template = "views/createuser.html.php";
    }
    
    private function validate($nom, $prenom, $email, $telephone)
    {
        return (
            preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) && 
            preg_match("#^0[1-9]([.]?[0-9]{2}){4}$#", $telephone) && 
            preg_match("#[a-zA-Z]{3,}#", $nom) && 
            preg_match("#[a-zA-Z]{3,}#", $prenom)
        );
    }
    
    private function validatePassword($password, $password2)
    {
        return (
            preg_match("#[a-zA-Z0-9]{6,12}#", $password) && 
            $password === $password2
        );
    }
    
    private function sendMail($login, $password, $email)
    {
        $objet = "CoVoiturage : Nouvel utilisateur";
        
        $message = "<html>
                        <head>
                            <title>CoVoiturage : Nouvel utilisateur</title>
                        </head>
                        <body>
                            <p>Vous venez de vous inscrire au site CoVoiturage : </p>
                            <p>Login : " . $login . "</p>
                            <p>Mot de passe : " . $password . "</p>
                            <p>Merci et à bientôt</p>
                        </body>
                    </html>";
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'To : ' . $email . "\r\n";
        $headers .= 'From: rozan.olivier@gmail.com' . "\r\n";
        
        mail($email, $objet, $message, $headers);
    }
    
    /**
     * confirmAction()
     * Confirme l'ajout d'un utilisateur, avec un message de confirmation
     */
    public function confirmAction()
    {
        $this->templateData['title'] = "Nouvel utilisateur créé";
        
        $user = new UserModel();
        
        /*if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }*/
        
        $this->template = "views/confirmnewuser.html.php";
    }
    
    /**
     * loginAction()
     * Connexion d'un membre
     */
    public function loginAction()
    {
        $this->templateData['title'] = "Authentification";
        $this->title = "Authentification";

        $user = new UserModel();
        
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = htmlspecialchars($_POST["login"]);
            $password = htmlspecialchars($_POST["password"]);
            
            $this->loginRequest = $user->auth($login, $password);
            
            if ($user->isAuth() && password_verify($password, $this->loginRequest["password"])) {
                header("Location: ?controller=default&action=mesoffres");
            }
            
            if (!password_verify($password, $this->loginRequest["password"])) {
                header("Location: ?controller=user&action=login&error");
            }
        }
        
        $this->template = "views/login.html.php";
    }
    
    /**
     * logoutAction()
     * Deconnexion
     */
    public function logoutAction()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['login']);
        unset($_SESSION['password']);

        $user = new UserModel();
        
        $this->templateData['title'] = "Authentification";
        $this->title = "Authentification";
        
        if ($user->isAuth()) {
            header('Location: ?controller=user&action=login');
        }
    }
    
    /**
     * profilAction()
     * Donne accès au profil de l'utilisateur connecté
     */
    public function profilAction()
    {
        $this->templateData['title'] = "PROFIL";
        $this->title = "PROFIL";
        
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
        $this->templateData['title'] = "MODIFIER PROFIL";
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
        
        $this->profil = $user->listUser($_SESSION['login'], $_SESSION['password']);
             
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        header("Location: ?controller=user&action=profil&modif");
        
        $this->template = "views/modifierprofil.html.php";
    }
    
    /**
     * modifiermotdepasseAction()
     * Permet de modifier le mot de passe de l'utilisateur connecté
     */
    public function modifiermotdepasseAction()
    {
        $this->templateData['title'] = "Modifier Mot De Passe";
        $this->title = "Modifier Mot De Passe";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
                
        $this->template = "views/modifiermotdepasse.html.php";
    }
    
    /**
     * updatepasswordAction()
     * execute la requete de modification le mot de passe de l'utilisateur connecté
     */
    public function updatepasswordAction()
    {
        $this->templateData['title'] = "Modifier Mot De Passe";
        $this->title = "Modifier Mot De Passe";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $password = htmlspecialchars($_POST["password"]);
        $password2 = htmlspecialchars($_POST["confirmPassword"]);
        
        if ($this->validatePassword($password, $password2)) {
            header('Location: ?controller=default&action=index&modifmdp');
        } 
        
        $this->template = "views/modifiermotdepasse.html.php";
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
