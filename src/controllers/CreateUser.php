<?php
/**
 * Description of CreateUser
 *
 * @author rozan_000
 */

require_once($rootPath . 'models/CreateUser.php');
require_once($rootPath . 'form/CreateUser.php');

class CreateUserController extends Controller {
    protected $template = 'views/createUserForm.html.php';
    protected $title = '';
    protected $data = array();
    
    public function createAction()
    {
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header('Location: ?controller=user&action=login');
        }
        
        $this->templateData['title'] = 'Nouvel Utilisateur';
        $this->templateData['formAction'] = '#';
        
        $userForm = new UserForm();
        
        $this->templateData['fields'] = $userForm->fields;
        $this->template = 'views/createForm.html.php';
    }
}
