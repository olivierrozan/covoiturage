<?php
/**
 * Description of Default
 *
 * @author rozan_000
 */

require_once($rootPath . 'models/User.php');

class DefaultController extends Controller {
    protected $template = "views/default.html.php";
    protected $title = "";
    protected $data = array();
    
    public function indexAction() 
    {
        $this->title = "Index";
        
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $this->data = $user->listAll('user');
    }
    
    public function render()
    {
        ob_start();
        
        $title = $this->title;
        $data = $this->data;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
