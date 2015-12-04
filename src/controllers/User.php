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
    
    public function createuserAction()
    {
        $this->templateData["title"] = "Nouvel Utilisateur";
        $this->templateData["formAction"] = "?controller=user&action=insert";
        
        $userForm = new CreateUserForm();
        
        $this->templateData['fields'] = $userForm->fields;
        $this->template = "views/createuser.html.php";
    }
    
    public function insertAction()
    {
        $this->templateData['title'] = "Authentification";
        $this->title = "Created";
        
        $user = new UserModel();
        
        $rep = $user->Created($_POST['Email'], $_POST['Nom'], $_POST['Prenom'], $_POST['Telephone']);
        
        header('Location: ?controller=user&action=login');
        
        $this->template = "views/createuser.html.php";
    }
    
    public function loginAction()
    {
        $this->templateData['title'] = "Authentification";
        $this->title = "Auth";
        
        $user = new UserModel();
        
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user->auth($_POST['login'], $_POST['password']);
        }
        
        if ($user->isAuth()) {
            header("Location: ?controller=default&action=index");
        }
        
        $this->template = "views/login.html.php";
    }
    
    public function logoutAction()
    {
        unset($_SESSION['uid']);

        $user = new UserModel();
        
        $this->templateData['title'] = "Authentification";
        $this->title = "Auth";
        
        if ($user->isAuth()) {
            header('Location: ?controller=user&action=login');
        }
    }

    public function render()
    {
        ob_start();
        
        // Chargement du template $this->template
        $data = $this->templateData;
        $title = $this->title;
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
