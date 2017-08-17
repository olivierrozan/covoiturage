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
        
        $this->title = "Nouvel Utilisateur";
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
    
    /**
     * validate()
     * Teste la saisie du nom, du prénom, du mail et du téléphone
     */
    private function validate($nom, $prenom, $email, $telephone)
    {
        return (
            preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) && 
            preg_match("#^0[1-9]([.]?[0-9]{2}){4}$#", $telephone) && 
            preg_match("#[a-zA-Z]{3,}#", $nom) && 
            preg_match("#[a-zA-Z]{3,}#", $prenom)
        );
    }
    
    /**
     * validatePassword()
     * Teste la validité du mot de passe
     */
    private function validatePassword($password, $password2)
    {
        return (
            preg_match("#[a-zA-Z0-9]{6,12}#", $password) && 
            $password === $password2
        );
    }
    
    /**
     * sendMail()
     * Envoi de mails
     */
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
        $this->title = "Nouvel utilisateur créé";
        
        /*$user = new UserModel();
        if (!$user->isAuth()) {
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
        $this->title = "Authentification";

        $user = new UserModel();
          
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            $login = htmlspecialchars($_POST["login"]);
            $password = htmlspecialchars($_POST["password"]);
            
            $this->loginRequest = $user->auth($login, $password);
            
            if (password_verify($password, $this->loginRequest["password"])) {
                $_SESSION["uid"] = $this->loginRequest["id"];
                $_SESSION["login"] = $login;
                $_SESSION["password"] = $password;
                
                header("Location: ?controller=offers&action=mesoffres&welcome");
            } else {
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
        unset($_SESSION['depart']);
        unset($_SESSION['arrivee']);

        $user = new UserModel();
        
        $this->title = "DECONNEXION";
        
        /*if ($user->isAuth()) {
            header('Location: ?controller=offers&action=index');   
        }*/
        
        $this->template = "views/logout.html.php";
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
