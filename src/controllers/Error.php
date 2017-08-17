<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recherche
 *
 * @author rozan_000
 */
class ErrorController extends Controller {
     
    protected $title = '';
    protected $data = array();
     /**
     * indexAction()
     * La page de départ
     */
    public function error404Action() 
    {
        $this->title = "Error 404";
        
        $this->template = "views/error404.html.php";
    }
    
    /**
     * render()
     * Affichage du rendu du contrôleur
     */
    public function render()
    {
        ob_start();
        
        $title = $this->title;
        $data = $this->data;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
