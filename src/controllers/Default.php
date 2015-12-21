<?php
/**
 * Description of Default
 *
 * @author rozan_000
 */

require_once($rootPath . 'models/User.php');
require_once($rootPath . 'models/Default.php');

class DefaultController extends Controller {
    protected $template = "";
    protected $title = "";
    protected $data = array(), $data2 = array(), $data3 = array();
    protected $dates = array();
    
    public function indexAction() 
    {
        $this->title = "Recherche";
        
        /*$user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }*/
        
        foreach ($this->data as $d) {
            $a = $d['date'] !== "permanent" ? utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "permanent";
            array_push($this->dates, $a);
        }
        
        $this->template = "views/index.html.php";
    }

    public function offresAction() 
    {
        $this->title = "Offres";
        
        /*$user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }*/
        
        $offers = new DefaultModel();
        
        if (isset($_POST["villeDepart"]) && isset($_POST["villeArrivee"])) {
            $_SESSION["depart"] = $_POST["villeDepart"];
            $_SESSION["arrivee"] = $_POST["villeArrivee"];
        }
        
        $this->data = $offers->listOffres($_SESSION["depart"], $_SESSION["arrivee"]);
        
        $this->template = "views/default.html.php";
    }
    
    public function mesoffresAction() 
    {
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listMesOffres();
        
        foreach ($this->data as $d) {
            $a = $d['date'] !== NULL ? "Le " . utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "Tous les " . $d['jour'];
            array_push($this->dates, $a);
        }
        
        $this->title = "Offres de " . $_SESSION["login"];
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function detailsoffreAction()
    {   
        $offers = new DefaultModel();
        
        $id = $_GET['id'];
        $this->data = $offers->listDetailOffre($id);
        $this->data2 = $offers->listPassagerOffre($id);
        $this->data3 = $offers->listPassagerRamassage($id);
        
        $a = $this->data[0]['date'] !== NULL ? "Le " . 
                utf8_encode(strftime("%d %B %Y", strtotime($this->data[0]['date']))) : "Tous les " . 
                $this->data[0]['jour'];
        array_push($this->dates, $a);
        
        /*$user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }*/
        
        $this->title = "Details Offre : ";
        $this->template = "views/detailoffre.html.php";
    }
    
    public function deleteoffreAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $offers->deleteOffre($_GET["id"]);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function modifieroffreformAction()
    {
        $this->title = "Modifier Offre";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new DefaultModel();
        
        $this->data = $offers->listMesOffresAModifier($_GET['id']);
        
        $this->template = "views/modifieroffre.html.php";
    }
    
    public function updateoffreAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new DefaultModel();
        
        $jour = htmlspecialchars($_POST['jour']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $depart = htmlspecialchars($_POST['depart']);
        $arrivee = htmlspecialchars($_POST['arrivee']);
        
        $default->updateOffre($jour, $date, $heure, $depart, $arrivee, $_GET["id"]);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/modifieroffres.html.php";
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
        
        $depart = htmlspecialchars($_POST["depart"]);
        $arrivee = htmlspecialchars($_POST["arrivee"]);
        
        $heure = htmlspecialchars($_POST["heure"]) . "h" . htmlspecialchars($_POST["minute"]);
        
        $default->insertOffreDepart($type, $jour, $date, $heure, $depart, $arrivee);
        
        header("Location: ?controller=default&action=mesoffres");
        
        $this->template = "views/ajouteroffre.html.php";
    }
    
    public function render()
    {
        ob_start();
        
        $title = $this->title;
        $data = $this->data;
        $data2 = $this->data2;
        $data3 = $this->data3;
        $dates = $this->dates;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}
