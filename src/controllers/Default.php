<?php
/**
 * Description of Default
 *
 * @author rozan_000
 */

require_once($rootPath . 'models/User.php');
require_once($rootPath . 'models/Default.php');

class DefaultController extends Controller {
    protected $template = "views/default.html.php";
    protected $title = "";
    protected $data = array(), $data2 = array();
    protected $dates = array(), $dates2 = array();
    
    public function indexAction() 
    {
        $this->title = "Index";
        
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listOffresDepart();
        
        foreach ($this->data as $d) {
            $a = $d['date'] !== "permanent" ? utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "permanent";
            array_push($this->dates, $a);
        }
        
        $this->data2 = $offers->listOffresArrivee();
        
        foreach ($this->data2 as $d) {
            $a = $d['date'] !== "permanent" ? utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "permanent";
            array_push($this->dates2, $a);
        }
    }
    
    public function arriveeAction() 
    {
        $this->title = "Arrivee";
        
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listOffresArrivee();
    }
    
    public function departAction() 
    {
        $this->title = "Depart";
        
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listOffresDepart();
    }
    
    public function mesoffresAction() 
    {
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listMesOffresDepart();
        
        foreach ($this->data as $d) {
            $a = $d['date'] !== "permanent" ? utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "permanent";
            array_push($this->dates, $a);
        }
        
        $this->data2 = $offers->listMesOffresArrivee();
        
        foreach ($this->data2 as $d) {
            $a = $d['date'] !== "permanent" ? utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "permanent";
            array_push($this->dates2, $a);
        }
        
        $x = 0;
        for ($i = 0; $i < count($this->dates); $i++) {
            if (isset($_POST[$i]) && $_POST[$i] === 'on') {
               $x++; 
            }
        }
        
        if ($x > 0) {
            header("Location: ?controller=default&action=mesoffres&ch=" . $x);
        }
        
        $this->title = "Offres de " . $_SESSION["login"];
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function deleteoffredepartAction()
    {
        $offers = new DefaultModel();
        
        $offers->deleteOffre("offresdepartentreprise", $_REQUEST["id"]);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function deleteoffrearriveeAction()
    {
        $offers = new DefaultModel();
        
        $offers->deleteOffre("offresarriveeentreprise", $_REQUEST["id"]);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function modifieroffredepartformAction()
    {
        $this->title = "Modifier Offre Depart";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listMesOffresDepartAModifier($_REQUEST['id']);
        
        $this->template = "views/modifieroffredepart.html.php";
    }
    
    public function modifieroffrearriveeformAction()
    {
        $this->title = "Modifier Offre";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        $id = htmlspecialchars($_REQUEST['id']);
        $this->data = $offers->listMesOffresArriveeAModifier($id);
        
        $this->template = "views/modifieroffrearrivee.html.php";
    }
    
    public function updateoffredepartAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new DefaultModel();
        $jour = htmlspecialchars($_REQUEST['jour']);
        $date = htmlspecialchars($_REQUEST['date']);
        $heure = htmlspecialchars($_REQUEST['heure']);
        $retour = htmlspecialchars($_REQUEST['retour']);
        $default->updateOffreDepart($jour, $date, $heure, $retour);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/modifieroffresdepart.html.php";
    }
    
    public function updateoffrearriveeAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new DefaultModel();
        $jour = htmlspecialchars($_REQUEST['jour']);
        $date = htmlspecialchars($_REQUEST['date']);
        $heure = htmlspecialchars($_REQUEST['heure']);
        $depart = htmlspecialchars($_REQUEST['depart']);
        $default->updateOffreArrivee($jour, $date, $heure, $depart);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/modifieroffresarrivee.html.php";
    }
    
    public function ajouteroffreAction()
    {
        $this->title = "Ajouter Offre";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $this->template = "views/ajouteroffre.html.php";
    }
    
    public function insertoffreAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new DefaultModel();
        $type = $_REQUEST['typeoffre'];
        
        if ($_REQUEST['periode'] === 'permanente') {
            $jour = htmlspecialchars($_POST["jour"]);
            $date = "permanent";
        } else {
            $date = htmlspecialchars($_POST["date"]);
        }
        
        if ($_REQUEST['typeoffre'] === "depart") {
            $retour = htmlspecialchars($_POST["retour"]);
        } else {
            $retour = htmlspecialchars($_POST["depart"]);
        }
        
        $heure = htmlspecialchars($_POST["heure"]) . "h" . htmlspecialchars($_POST["minute"]);
        
        $default->insertOffreDepart($type, $jour, $date, $heure, $retour);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/ajouteroffre.html.php";
    }
    
    public function render()
    {
        ob_start();
        
        $title = $this->title;
        $data = $this->data;
        $data2 = $this->data2;
        $dates = $this->dates;
        $dates2 = $this->dates2;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
