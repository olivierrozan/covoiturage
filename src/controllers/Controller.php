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
    
    public function __construct($rootPath) 
    {
        $this->rootPath = $rootPath;
    }
    
    public function render()
    {
        ob_start();
        
        $data = $this->templateData;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
