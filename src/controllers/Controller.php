<?php
/**
 * Description of Controller
 *
 * @author rozan_000
 */
class Controller {
    protected $template = "";
    protected $templateData = array();
    protected $rootPath = "";
    
    /**
     * __construct()
     * Constructeur du contrôleur
     */
    public function __construct($rootPath) 
    {
        $this->rootPath = $rootPath;
    }
    
    /**
     * render()
     * Gère l'affichage
     */
    public function render()
    {
        ob_start();
        
        $data = $this->templateData;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
